@extends('layouts.app')
@section('content')
    <section class="max-w-6xl mx-auto py-12 px-6">

        <div class="bg-white shadow-lg rounded-2xl p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Highest & Lowest Deal Value per Property Type</h1>

                <a href="{{ route('reports.deal_range_by_property_type.export') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Export CSV
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-4 border-b">Property Type</th>
                        <th class="py-3 px-4 border-b">Min Transaction (€)</th>
                        <th class="py-3 px-4 border-b">Max Transaction (€)</th>
                        <th class="py-3 px-4 border-b">Average Transaction (€)</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-800">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 font-medium">{{ $row->type }}</td>
                            <td class="py-3 px-4">{{ number_format($row->min_value, 2) }}</td>
                            <td class="py-3 px-4">{{ number_format($row->max_value, 2) }}</td>
                            <td class="py-3 px-4 font-semibold text-gray-900">{{ number_format($row->avg_value, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
@endsection
