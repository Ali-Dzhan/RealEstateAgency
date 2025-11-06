@extends('layouts.app')
@section('content')
    <section class="max-w-6xl mx-auto py-12 px-6">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Deals by Region</h1>

            <a href="{{ route('reports.deals_by_region.export') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                Export CSV
            </a>
        </div>

        @foreach($data as $regionData)
            <div class="bg-white shadow-lg rounded-xl p-6 mb-10">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-blue-700">
                        {{ $regionData['region'] }}
                    </h2>

                    <p class="text-gray-600 text-sm">
                        <span class="font-semibold">{{ $regionData['offers_count'] }}</span> deals |
                        Total value:
                        <span class="font-semibold">€{{ number_format($regionData['total_value'], 2) }}</span>
                    </p>
                </div>

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full text-sm text-center">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3 text-left">Property</th>
                            <th class="px-4 py-3 text-left">Agent</th>
                            <th class="px-4 py-3 text-left">Client</th>
                            <th class="px-4 py-3 text-right">Price (€)</th>
                            <th class="px-4 py-3">Created</th>
                            <th class="px-4 py-3">Updated</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 text-gray-800">
                        @foreach($regionData['offers'] as $offer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $offer->id }}</td>
                                <td class="px-4 py-3 text-left">{{ $offer->property->address ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-left">{{ $offer->agent->first_name ?? '' }} {{ $offer->agent->last_name ?? '' }}</td>
                                <td class="px-4 py-3 text-left">{{ $offer->client->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($offer->price, 2) }}</td>
                                <td class="px-4 py-3">{{ $offer->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">{{ $offer->updated_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        @endforeach

    </section>
@endsection
