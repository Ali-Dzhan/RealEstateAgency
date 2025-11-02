@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-12 px-6">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Offer History – {{ $offer->property->address ?? 'Unknown Property' }}
            </h1>

            <table class="min-w-full text-left border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Changed By</th>
                    <th class="px-4 py-3">Field</th>
                    <th class="px-4 py-3">Old</th>
                    <th class="px-4 py-3">New</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse($histories as $record)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $record->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ $record->user->name ?? 'System' }}</td>
                        <td class="px-4 py-2 font-medium">{{ ucfirst($record->field_changed) }}</td>
                        <td class="px-4 py-2 text-red-600">{{ $record->old_value }}</td>
                        <td class="px-4 py-2 text-green-600">{{ $record->new_value }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            No history records found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                <a href="{{ route('offers.show', $offer->id) }}"
                   class="text-blue-600 hover:underline font-medium">
                    ← Back to Offer Details
                </a>
            </div>
        </div>
    </section>
@endsection
