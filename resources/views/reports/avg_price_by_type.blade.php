@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">

        <div class="bg-white shadow-lg rounded-2xl p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Average Price by Type and Region</h1>

                <a href="{{ route('reports.avg_price_by_type.export') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Export CSV
                </a>
            </div>

            <!-- Filters -->
            <form method="GET" action="{{ route('reports.avg_price_by_type') }}" class="flex flex-wrap gap-6 mb-8">

                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                    <select name="region" id="region"
                            class="border-gray-300 rounded-lg p-2 w-48 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Regions</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" @selected($selectedRegion == $region->id)>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                    <select name="type" id="type"
                            class="border-gray-300 rounded-lg p-2 w-48 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Types</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected($selectedType == $type->id)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Filter
                </button>
            </form>

            <!-- Results -->
            @if($data->count())
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-center">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="py-3 px-4 border-b">Region</th>
                            <th class="py-3 px-4 border-b">Property Type</th>
                            <th class="py-3 px-4 border-b">Average Price</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-800">
                        @foreach($data as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $row->region }}</td>
                                <td class="py-3 px-4">{{ $row->type }}</td>
                                <td class="py-3 px-4 font-semibold">{{ number_format($row->avg_price, 2) }} лв.</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-6">No results found for the selected filters.</p>
            @endif

        </div>

    </section>
@endsection
