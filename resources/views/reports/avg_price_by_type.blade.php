@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Average Price by Type and Region</h1>

        {{-- Filters --}}
        <form method="GET" action="{{ route('reports.avg_price_by_type') }}" class="mb-6 flex gap-4 items-end">
            <div>
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <select name="region" id="region" class="border rounded-lg p-2 w-48">
                    <option value="">All Regions</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ $selectedRegion == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Property Type</label>
                <select name="type" id="type" class="border rounded-lg p-2 w-48">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $selectedType == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Filter
            </button>
        </form>

        {{-- Results --}}
        @if($data->count())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Region</th>
                        <th class="border px-4 py-2 text-left">Property Type</th>
                        <th class="border px-4 py-2 text-left">Average Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $row->region }}</td>
                            <td class="border px-4 py-2">{{ $row->type }}</td>
                            <td class="border px-4 py-2">{{ number_format($row->avg_price, 2) }} лв.</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No results found for the selected filters.</p>
        @endif
    </section>
@endsection
