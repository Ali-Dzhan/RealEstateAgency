@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-12 px-6 md:px-10">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Offer Details</h1>


                @if(auth()->user()->role === 'admin' ||
                    (auth()->user()->role === 'agent' && $offer->agent_id === auth()->user()->agent->id))
                    <a href="{{ route('offers.history', $offer->id) }}"
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        View Change History
                    </a>
                @endif


                <a href="{{ route('offers.index') }}"
                   class="text-blue-600 font-medium hover:underline">
                    ← Back to Offers
                </a>
            </div>

            <!-- Property Info -->
            <div class="border-b pb-6 mb-6">
                <h2 class="text-2xl font-semibold mb-2">{{ $offer->property->address ?? '—' }}</h2>
                <p class="text-gray-600">Property ID: #{{ $offer->property->id ?? '—' }}</p>

                @if($offer->property && $offer->property->photos->isNotEmpty())
                    <img src="{{ asset($offer->property->photos->first()->path) }}"
                         alt="Property"
                         class="mt-4 w-full h-64 object-cover rounded-lg shadow">
                @endif
            </div>

            <!-- Offer Info -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Agent</h3>
                    <p class="text-gray-600">{{ $offer->agent->first_name ?? '—' }} {{ $offer->agent->last_name ?? '' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Client</h3>
                    <p class="text-gray-600">{{ $offer->client->name ?? '—' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Price</h3>
                    <p class="text-gray-700 font-medium">{{ number_format($offer->price, 2) }} €</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Status</h3>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($offer->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($offer->status === 'accepted') bg-green-100 text-green-700
                        @elseif($offer->status === 'rejected') bg-red-100 text-red-700
                        @endif">
                        {{ ucfirst($offer->status) }}
                    </span>
                </div>
            </div>

            <!-- Message / Notes -->
            @if(!empty($offer->message))
                <div class="bg-gray-50 border-l-4 border-blue-500 p-4 rounded-lg mb-8">
                    <p class="text-gray-700 italic">“{{ $offer->message }}”</p>
                </div>
            @endif

            <!-- Actions -->
            @if(auth()->user()->role === 'client'
                && $offer->status === 'pending'
                && auth()->user()->client->id === $offer->client_id)

                <div class="flex gap-4">
                    <form action="{{ route('offers.accept', $offer->id) }}" method="POST" onsubmit="return confirm('Accept this offer?')">
                        @csrf
                        @method('PATCH')
                        <button class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Accept Offer
                        </button>
                    </form>

                    <form action="{{ route('offers.reject', $offer->id) }}" method="POST" onsubmit="return confirm('Reject this offer?')">
                        @csrf
                        @method('PATCH')
                        <button class="px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                            Reject Offer
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection
