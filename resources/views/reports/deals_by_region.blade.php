@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Deals by Region</h1>

        @foreach($data as $regionData)
            <div class="mb-8 bg-white shadow rounded-lg p-4">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold text-blue-700">{{ $regionData['region'] }}</h2>
                    <div class="text-gray-600">
                        <strong>{{ $regionData['offers_count'] }}</strong> deals |
                        Total value: <strong>€{{ number_format($regionData['total_value'], 2) }}</strong>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">#</th>
                            <th class="p-2 border">Property</th>
                            <th class="p-2 border">Agent</th>
                            <th class="p-2 border">Client</th>
                            <th class="p-2 border">Price (€)</th>
                            <th class="p-2 border">Created At</th>
                            <th class="p-2 border">Updated At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($regionData['offers'] as $offer)
                            <tr>
                                <td class="border p-2 text-center">{{ $offer->id }}</td>
                                <td class="border p-2">{{ $offer->property->address ?? 'N/A' }}</td>
                                <td class="border p-2">{{ $offer->agent->first_name ?? '' }} {{ $offer->agent->last_name ?? '' }}</td>
                                <td class="border p-2">{{ $offer->client->name ?? 'N/A' }}</td>
                                <td class="border p-2 text-right">{{ number_format($offer->price, 2) }}</td>
                                <td class="border p-2">{{ $offer->created_at->format('Y-m-d') }}</td>
                                <td class="border p-2">{{ $offer->updated_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </section>
@endsection
