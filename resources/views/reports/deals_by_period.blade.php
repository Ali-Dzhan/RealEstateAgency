@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Deals by Period</h1>

        <form method="GET" class="mb-4 flex space-x-3">
            <input type="date" name="start_date" value="{{ $start }}" class="border rounded p-2">
            <input type="date" name="end_date" value="{{ $end }}" class="border rounded p-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Property</th>
                    <th class="p-2 border">Agent</th>
                    <th class="p-2 border">Client</th>
                    <th class="p-2 border">Price (€)</th>
                    <th class="p-2 border">Created</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $offer)
                    <tr>
                        <td class="p-2 border text-center">{{ $offer->id }}</td>
                        <td class="p-2 border">{{ $offer->property->address ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $offer->agent->first_name ?? '' }} {{ $offer->agent->last_name ?? '' }}</td>
                        <td class="p-2 border">{{ $offer->client->name ?? 'N/A' }}</td>
                        <td class="p-2 border text-right">{{ number_format($offer->price, 2) }}</td>
                        <td class="p-2 border">{{ $offer->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
