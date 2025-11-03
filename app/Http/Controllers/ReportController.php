<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    /**
     * 1) Offers (accepted) grouped by region — includes full offer rows per region.
     */
    public function dealsByRegion()
    {
        // load accepted offers with relations
        $offers = Offer::with(['property.region', 'agent', 'client'])
            ->where('status', 'accepted')
            ->orderByDesc('created_at')
            ->get();

        // group by region name, create structure: region => [meta + offers]
        $data = $offers->groupBy(function ($o) {
            return optional($o->property->region)->name ?: 'Unknown';
        })->map(function ($offers, $region) {
            return [
                'region' => $region,
                'offers_count' => $offers->count(),
                'total_value' => $offers->sum('price'),
                'offers' => $offers,
            ];
        })->values();

        return view('reports.deals_by_region', compact('data'));
    }

    /**
     * 2) Offers accepted within a date period — returns full offer rows and the period.
     */
    public function dealsByPeriod(Request $request)
    {
        $start = $request->input('start_date', Carbon::now()->subMonth()->toDateString());
        $end = $request->input('end_date', Carbon::now()->toDateString());

        $offers = Offer::with(['property.region', 'agent', 'client'])
            ->where('status', 'accepted')
            ->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->orderBy('created_at')
            ->get();

        return view('reports.deals_by_period', [
            'data' => $offers,
            'start' => $start,
            'end' => $end,
        ]);
    }

    /**
     * 3) Average time (days) from offer creation to acceptance, plus individual deal times.
     */
    public function avgDealTime()
    {
        $deals = Offer::with(['property', 'agent', 'client'])
            ->where('status', 'accepted')
            ->select('id', 'property_id', 'agent_id', 'client_id', 'created_at', 'updated_at', 'price')
            ->get()
            ->map(function ($o) {
                $created = $o->created_at;
                $updated = $o->updated_at ?? $created;
                $days = $created ? $created->diffInDays($updated) : null;
                return [
                    'offer' => $o,
                    'deal_days' => $days,
                ];
            });

        $avg = $deals->pluck('deal_days')->filter()->avg();
        $avg = is_null($avg) ? null : round($avg, 2);

        return view('reports.avg_deal_time', compact('deals', 'avg'));
    }

    /**
     * 4) Top agents by accepted offers (count + total value). Returns agent id + name + totals.
     */
    public function topAgents()
    {
        $data = Offer::where('status', 'accepted')
            ->select('agent_id', DB::raw('COUNT(*) as total_deals'), DB::raw('SUM(price) as total_value'))
            ->groupBy('agent_id')
            ->orderByDesc('total_deals')
            ->with('agent') // will eager load agent relation for mapping later
            ->get();

        // eager load agent models for each agent_id present
        $agentIds = $data->pluck('agent_id')->unique()->filter()->all();
        $agents = \App\Models\Agent::whereIn('id', $agentIds)->get()->keyBy('id');

        // Map to nice structure
        $data = $data->map(function ($row) use ($agents) {
            $agent = $agents->get($row->agent_id);
            return [
                'agent_id' => $row->agent_id,
                'first_name' => $agent->first_name ?? null,
                'last_name' => $agent->last_name ?? null,
                'total_deals' => (int) $row->total_deals,
                'total_value' => (float) $row->total_value,
            ];
        });

        return view('reports.top_agents', compact('data'));
    }

    /**
     * 5) Properties without any viewings in the last 30 days — include property details and last viewing date (if any).
     */
    public function propertiesWithoutViewings()
    {
        $threshold = Carbon::now()->subDays(30);

        // Properties that do NOT have a viewing created_at >= threshold
        $properties = Property::with(['region', 'agent'])
            ->whereDoesntHave('viewings', function ($q) use ($threshold) {
                $q->where('created_at', '>=', $threshold);
            })
            ->get()
            ->map(function ($prop) {
                // last viewing (if any)
                $lastViewing = $prop->viewings()->orderByDesc('created_at')->first();
                return [
                    'property' => $prop,
                    'last_viewing_at' => $lastViewing ? $lastViewing->created_at : null,
                ];
            });

        return view('reports.properties_without_viewings', compact('properties'));
    }

    /**
     * 6) Average accepted offer price by property type and region (plus counts).
     */
    public function avgPriceByType(Request $request)
    {
        $selectedRegion = $request->input('region');
        $selectedType = $request->input('type');

        $regions = Region::all();
        $types = PropertyType::all();

        $query = Property::join('regions', 'properties.region_id', '=', 'regions.id')
            ->join('property_types', 'properties.property_type_id', '=', 'property_types.id');

        // Apply filters if present
        if ($selectedRegion) {
            $query->where('regions.id', $selectedRegion);
        }

        if ($selectedType) {
            $query->where('property_types.id', $selectedType);
        }

        // Calculate average price
        $data = $query->select(
            'property_types.name as type',
            'regions.name as region',
            DB::raw('AVG(properties.price) as avg_price'),
            DB::raw('COUNT(properties.id) as property_count')
        )
            ->groupBy('property_types.name', 'regions.name')
            ->orderBy('regions.name')
            ->get();

        return view('reports.avg_price_by_type',
            compact('data', 'regions', 'types', 'selectedRegion', 'selectedType'));
    }

    /**
     * 7) Total revenue by region (plus counts and average deal value).
     */
    public function revenueByRegion(Request $request)
    {
        $data = DB::table('transactions')
            ->join('offers', 'transactions.offer_id', '=', 'offers.id')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('regions', 'properties.region_id', '=', 'regions.id')
            ->where('offers.status', 'accepted')
            ->select(
                'regions.name as region',
                DB::raw('SUM(transactions.amount) as total_revenue'),
                DB::raw('COUNT(transactions.id) as total_deals'),
                DB::raw('AVG(transactions.amount) as avg_deal_value')
            )
            ->groupBy('regions.name')
            ->orderByDesc('total_revenue')
            ->get();

        return view('reports.revenue_by_region', compact('data'));
    }

    /**
     * 8) Average Transaction Value by Agent.
     */
    public function avgTransactionByAgent()
    {
        $data = DB::table('transactions')
            ->join('offers', 'transactions.offer_id', '=', 'offers.id')
            ->join('agents', 'offers.agent_id', '=', 'agents.id')
            ->where('offers.status', 'accepted')
            ->select(
                'agents.first_name',
                'agents.last_name',
                DB::raw('AVG(transactions.amount) as avg_value'),
                DB::raw('COUNT(transactions.id) as total_transactions'),
                DB::raw('MAX(transactions.amount) as max_value')
            )
            ->groupBy('agents.id', 'agents.first_name', 'agents.last_name')
            ->orderByDesc('avg_value')
            ->get();

        return view('reports.avg_transaction_by_agent', compact('data'));
    }

    /**
     * 9) Highest & Lowest Deal Value per Property Type.
     */
    public function dealRangeByPropertyType()
    {
        $data = DB::table('transactions')
            ->join('offers', 'transactions.offer_id', '=', 'offers.id')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('property_types', 'properties.property_type_id', '=', 'property_types.id')
            ->where('offers.status', 'accepted')
            ->select(
                'property_types.name as type',
                DB::raw('MIN(transactions.amount) as min_value'),
                DB::raw('MAX(transactions.amount) as max_value'),
                DB::raw('AVG(transactions.amount) as avg_value')
            )
            ->groupBy('property_types.name')
            ->orderBy('type')
            ->get();

        return view('reports.deal_range_by_property_type', compact('data'));
    }

    /**
     * 10) Monthly Transaction Summary.
     */
    public function monthlyTransactionSummary(Request $request)
    {
        $start = $request->input('start_date', Carbon::now()->subMonths(6)->startOfMonth()->toDateString());
        $end = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $data = DB::table('transactions')
            ->join('offers', 'transactions.offer_id', '=', 'offers.id')
            ->where('offers.status', 'accepted')
            ->whereBetween('transactions.created_at', [$start, $end])
            ->select(
                DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as month'),
                DB::raw('SUM(transactions.amount) as total_revenue'),
                DB::raw('COUNT(transactions.id) as total_transactions'),
                DB::raw('AVG(transactions.amount) as avg_value')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('reports.monthly_transaction_summary', compact('data', 'start', 'end'));
    }

}
