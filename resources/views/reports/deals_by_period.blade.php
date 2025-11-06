@extends('layouts.app')
@section('content')
    <section class="max-w-6xl mx-auto py-12 px-6">

        <div class="bg-white shadow-lg rounded-2xl p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Deals by Period</h1>

                <a href="{{ route('reports.deals_by_period.export') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Export CSV
                </a>
            </div>

            <form method="GET" class="flex items-end gap-4 mb-6">
                <div>
                    <label class="text-sm text-gray-600">Start</label>
                    <input type="date" name="start_date" value="{{ $start }}"
                           class="border rounded-lg p-2 w-40">
                </div>

                <div>
                    <label class="text-sm text-gray-600">End</label>
                    <input type="date" name="end_date" value="{{ $end }}"
                           class="border rounded-lg p-2 w-40">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Filter
                </button>
            </form>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-4 border-b">#</th>
                        <th class="py-3 px-4 border-b">Property</th>
                        <th class="py-3 px-4 border-b">Agent</th>
                        <th class="py-3 px-4 border-b">Client</th>
                        <th class="py-3 px-4 border-b">Price (€)</th>
                        <th class="py-3 px-4 border-b">Created</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-800">
                    @foreach($data as $offer)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $offer->id }}</td>
                            <td class="py-3 px-4 text-left">{{ $offer->property->address ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-left">
                                {{ $offer->agent->first_name ?? '' }} {{ $offer->agent->last_name ?? '' }}
                            </td>
                            <td class="py-3 px-4 text-left">{{ $offer->client->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 font-semibold text-right">{{ number_format($offer->price, 2) }}</td>
                            <td class="py-3 px-4">{{ $offer->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
@endsection
