@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-800">📋 Viewings</h1>
        </div>

        @if ($viewings->isEmpty())
            <div class="bg-white shadow-md rounded-2xl p-10 text-center">
                <p class="text-gray-500 text-lg">No viewings found.</p>
            </div>
        @else
            <div class="overflow-hidden bg-white shadow-lg rounded-2xl">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 uppercase text-sm tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Property</th>
                        <th class="px-6 py-3 text-left font-semibold">Agent</th>
                        <th class="px-6 py-3 text-left font-semibold">Client</th>
                        <th class="px-6 py-3 text-left font-semibold">Scheduled On</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-left font-semibold">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($viewings as $viewing)
                        <tr class="border-b hover:bg-blue-50 transition duration-200">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('properties.show', $viewing->property->id) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $viewing->property->address ?? '—' }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $viewing->agent?->first_name }} {{ $viewing->agent?->last_name }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $viewing->client?->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($viewing->scheduled_on)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($viewing->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($viewing->status === 'completed') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($viewing->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-3">
                                {{-- Agent actions --}}
                                @if(auth()->user()->role === 'agent')
                                    <a href="{{ route('viewings.edit', $viewing->id) }}"
                                       class="text-blue-600 hover:underline font-medium">Update</a>
                                @endif

                                {{-- Client actions --}}
                                @if(auth()->user()->role === 'client')
                                    @if($viewing->status === 'pending')
                                        <form action="{{ route('viewings.cancel', $viewing->id) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this viewing?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:underline font-medium">
                                                Cancel
                                            </button>
                                        </form>
                                    @elseif($viewing->status === 'completed')
                                        <a href="{{ route('viewings.review', $viewing->id) }}"
                                           class="text-blue-600 hover:underline font-medium">
                                            Leave Review
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm">No action</span>
                                    @endif
                                @endif

                                {{-- Admin actions --}}
                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('viewings.destroy', $viewing->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $viewings->links() }}
            </div>
        @endif
    </section>
@endsection
