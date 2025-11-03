@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Properties Without Viewings (30 Days)</h1>

        <table class="min-w-full border text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Property</th>
                <th class="p-2 border">Region</th>
                <th class="p-2 border">Agent</th>
                <th class="p-2 border">Last Viewing</th>
            </tr>
            </thead>
            <tbody>
            @forelse($properties as $row)
                <tr>
                    <td class="border p-2">{{ $row['property']->address }}</td>
                    <td class="border p-2">{{ $row['property']->region->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $row['property']->agent->first_name ?? '' }} {{ $row['property']->agent->last_name ?? '' }}</td>
                    <td class="border p-2 text-center">
                        {{ $row['last_viewing_at'] ? $row['last_viewing_at']->format('Y-m-d') : '—' }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center p-4 text-gray-500">All properties had recent viewings ✅</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
@endsection
