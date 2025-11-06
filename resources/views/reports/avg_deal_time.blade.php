@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">

        <div class="bg-white shadow-lg rounded-2xl p-8">
            <div class="flex flex-wrap justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Average Deal Time</h1>

                <a href="{{ route('reports.avg_deal_time.export') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Export CSV
                </a>
            </div>

            <p class="text-gray-700 mb-6">
                Average time to close a deal:
                <span class="font-semibold text-gray-900">{{ $avg ? $avg . ' days' : 'N/A' }}</span>
            </p>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-4 border-b">Offer #</th>
                        <th class="py-3 px-4 border-b">Property</th>
                        <th class="py-3 px-4 border-b">Agent</th>
                        <th class="py-3 px-4 border-b">Price (€)</th>
                        <th class="py-3 px-4 border-b">Days to Close</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-800">
                    @foreach($deals as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $row['offer']->id }}</td>
                            <td class="py-3 px-4">{{ $row['offer']->property->address ?? 'N/A' }}</td>
                            <td class="py-3 px-4">{{ $row['offer']->agent->first_name ?? '' }} {{ $row['offer']->agent->last_name ?? '' }}</td>
                            <td class="py-3 px-4">{{ number_format($row['offer']->price, 2) }}</td>
                            <td class="py-3 px-4">{{ $row['deal_days'] ?? '—' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
@endsection
