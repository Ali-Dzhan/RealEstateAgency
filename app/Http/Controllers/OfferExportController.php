<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class OfferExportController extends Controller
{
    /*
     * Stream CSV for offers.
     *
     * @param Request $request
     * @param string $type // 'active' or 'done'
     */
    public function export(Request $request, string $type): StreamedResponse
    {
        $user = $request->user();

        if (!in_array($type, ['active', 'done'])) {
            abort(400, 'Invalid export type.');
        }

        // Build base query
        $query = Offer::with(['property', 'agent', 'client'])->orderBy('id');

        // Filter by type
        if ($type === 'active') {
            $query->where('status', 'pending');
            $label = 'active-offers';
        } else {
            $query->where('status', 'accepted');
            $label = 'done-deals';
        }

        // ACL: Agents see only their offers; Admins see all
        if ($user->role === 'agent') {
            $agent = $user->agent ?? null;
            if (!$agent) {
                abort(403, 'No agent profile found.');
            }
            $query->where('agent_id', $agent->id);
        } elseif ($user->role !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        // File name
        $date = Carbon::now()->format('Ymd_His');
        $filename = sprintf("%s_%s_%s.csv", $label, $user->username ?? $user->id, $date);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($query) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($handle, [
                'Offer ID',
                'Property ID',
                'Property Address',
                'Agent ID',
                'Agent Name',
                'Client ID',
                'Client Name',
                'Price (€)',
                'Status',
                'Signed On',
                'Created At',
                'Updated At',
            ]);

            $query->chunkById(200, function ($offers) use ($handle) {
                foreach ($offers as $offer) {
                    fputcsv($handle, [
                        $offer->id,
                        optional($offer->property)->id,
                        optional($offer->property)->address,
                        optional($offer->agent)->id,
                        trim((optional($offer->agent)->first_name ?? '') . ' ' . (optional($offer->agent)->last_name ?? '')),
                        optional($offer->client)->id,
                        optional($offer->client)->name,
                        number_format($offer->price ?? 0, 2, '.', ''),
                        $offer->status,
                        $offer->signed_on ? (string) $offer->signed_on : '',
                        $offer->created_at ? $offer->created_at->toDateTimeString() : '',
                        $offer->updated_at ? $offer->updated_at->toDateTimeString() : '',
                    ]);
                }
            });

            fclose($handle);
        };

        // Log export action
        auditLogExport($user, $type);

        // Return the streamed CSV
        return response()->stream($callback, 200, $headers);
    }
}
