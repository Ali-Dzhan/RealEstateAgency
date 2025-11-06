@extends('layouts.app')
@section('content')
    <section class="max-w-6xl mx-auto py-12 px-6">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                Properties Without Viewings (30 Days)
            </h1>

            <a href="{{ route('reports.properties_without_viewings.export') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                Export CSV
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">Property</th>
                        <th class="px-4 py-3 text-left">Region</th>
                        <th class="px-4 py-3 text-left">Agent</th>
                        <th class="px-4 py-3">Last Viewing</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 text-gray-800">
                    @forelse($properties as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-left">{{ $row['property']->address }}</td>
                            <td class="px-4 py-3 text-left">{{ $row['property']->region->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-left">
                                {{ $row['property']->agent->first_name ?? '' }} {{ $row['property']->agent->last_name ?? '' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $row['last_viewing_at'] ? $row['last_viewing_at']->format('Y-m-d') : '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-gray-500">
                                All properties had recent viewings
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </section>
@endsection
