<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\Viewing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewingController extends Controller
{
    /**
     * Client schedules a new viewing
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'scheduled_on' => 'required|date|after:now',
        ]);

        $property = Property::find($request->property_id);
        $agentId = $property->agent_id;

        $requestedTime = Carbon::parse($request->scheduled_on);
        $start = $requestedTime->copy()->subHours(3);
        $end = $requestedTime->copy()->addHours(3);

        $existing = Viewing::where('agent_id', $agentId)
            ->whereBetween('scheduled_on', [$start, $end])
            ->exists();

        if ($existing) {
            return redirect()->back()->withErrors([
                'scheduled_on' => 'The agent is already booked within 3 hours of this time.
                 Please choose another time.',
            ]);
        }

        Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agentId,
            'client_id' => $user->client->id,
            'scheduled_on' => $requestedTime,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Viewing scheduled successfully.');
    }

    /**
     * Agent updates viewing after it happens
     */
    public function update(Request $request, Viewing $viewing)
    {
        $request->validate([
            'status' => 'in:pending,completed,cancelled',
            'client_review' => 'nullable|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
            'agent_notes' => 'nullable|string|max:1000',
        ]);

        $viewing->update($request->only(['status', 'client_review', 'rating', 'agent_notes']));

        return redirect()->back()->with('success', 'Viewing updated successfully.');
    }

    /**
     * List viewings for agent or client
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $viewings = Viewing::with(['property', 'agent', 'client'])
                ->latest()
                ->paginate(5);
        } elseif ($user->role === 'agent') {
            $viewings = Viewing::where('agent_id', $user->agent->id)
                ->with(['property', 'client'])
                ->latest()
                ->paginate(5);
        } else {
            $viewings = Viewing::where('client_id', $user->client->id)
                ->with(['property', 'agent'])
                ->latest()
                ->paginate(5);
        }

        return view('viewings.index', compact('viewings'));
    }

    public function cancel(Viewing $viewing)
    {
        $user = auth()->user();

        if ($user->role === 'client' && $viewing->client_id === $user->client->id) {
            $viewing->update(['status' => 'cancelled']);
            return back()->with('success', 'Viewing cancelled successfully.');
        }

        if ($user->role === 'agent' && $viewing->agent_id === $user->agent->id) {
            $viewing->update(['status' => 'cancelled']);
            return back()->with('success', 'Viewing cancelled successfully.');
        }

        abort(403, 'Unauthorized action.');
    }

    public function review(Viewing $viewing)
    {
        return view('viewings.review', compact('viewing'));
    }

    public function edit(Viewing $viewing)
    {
        $user = auth()->user();

        if ($user->role !== 'agent' && $user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if ($user->role === 'agent' && $viewing->agent_id !== $user->agent->id) {
            abort(403, 'Unauthorized');
        }

        return view('viewings.edit', compact('viewing'));
    }
}
