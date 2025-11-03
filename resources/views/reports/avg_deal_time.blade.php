@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Average Deal Time</h1>

        <p class="mb-4 text-gray-700">
            Average time to close a deal:
            <strong>{{ $avg ? $avg . ' days' : 'N/A' }}</strong>
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Offer #</th>
                    <th class="p-2 border">Property</th>
                    <th class="p-2 border">Agent</th>
                    <th class="p-2 border">Price (€)</th>
                    <th class="p-2 border">Days to Close</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deals as $row)
                    <tr>
                        <td class="border p-2 text-center">{{ $row['offer']->id }}</td>
                        <td class="border p-2">{{ $row['offer']->property->address ?? 'N/A' }}</td>
                        <td class="border p-2">{{ $row['offer']->agent->first_name ?? '' }} {{ $row['offer']->agent->last_name ?? '' }}</td>
                        <td class="border p-2 text-right">{{ number_format($row['offer']->price, 2) }}</td>
                        <td class="border p-2 text-center">{{ $row['deal_days'] ?? '—' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
