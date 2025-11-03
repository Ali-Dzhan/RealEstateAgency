@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Reports Dashboard</h1>

        <div class="grid md:grid-cols-2 gap-6">
            <a href="{{ route('reports.deals_by_region') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">1. Deals by Region</a>
            <a href="{{ route('reports.deals_by_period') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">2. Deals by Period</a>
            <a href="{{ route('reports.avg_deal_time') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">3. Average Deal Time</a>
            <a href="{{ route('reports.top_agents') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">4. Top Agents</a>
            <a href="{{ route('reports.properties_without_viewings') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">5. Inactive Properties (30+ days)</a>
            <a href="{{ route('reports.avg_price_by_type') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">6. Avg Price by Type/Region</a>
            <a href="{{ route('reports.revenue_by_region') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">7. Revenue by Region</a>
            <a href="{{ route('reports.avg_transaction_by_agent') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">8. Average Transaction Value by Agent</a>
            <a href="{{ route('reports.deal_range_by_property_type') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">9. Highest & Lowest Deal Value per Property Type</a>
            <a href="{{ route('reports.monthly_transaction_summary') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4
                rounded-xl font-semibold text-center">10. Monthly Transaction Summary</a>
        </div>
    </section>
@endsection
