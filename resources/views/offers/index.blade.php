@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto py-12 px-6 md:px-10 space-y-8">

        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">💼 Offers</h1>

            @if(auth()->user()->role === 'agent')
                <a href="{{ route('offers.create') }}"
                   class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">
                    + New Offer
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @forelse($offers as $offer)
            <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col md:flex-row justify-between items-start md:items-center hover:shadow-xl transition">

                <!-- Left: Offer Info -->
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $offer->property->address ?? '—' }}
                    </h2>

                    <p class="text-gray-600">
                        <strong>Agent:</strong> {{ $offer->agent->first_name ?? '—' }}
                        <span class="mx-2 text-gray-400">•</span>
                        <strong>Client:</strong> {{ $offer->client->name ?? '—' }}
                    </p>

                    <p class="text-gray-700 font-medium">
                        💶 {{ number_format($offer->price, 2) }} €
                    </p>

                    <p class="text-sm">
                        <span class="font-semibold">Status:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($offer->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($offer->status === 'accepted') bg-green-100 text-green-700
                            @elseif($offer->status === 'rejected') bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst($offer->status) }}
                        </span>
                    </p>
                </div>

                <!-- Right: Actions -->
                <div class="flex items-center gap-3 mt-4 md:mt-0">

                    <a href="{{ route('offers.show', $offer->id) }}"
                       class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg hover:bg-gray-200 transition">
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-lg py-10">
                No offers available.
            </div>
        @endforelse

        <div class="mt-8">
            {{ $offers->links() }}
        </div>

    </section>
@endsection
