@extends('layouts.app')

@section('content')
    <section class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Create Offer</h1>

        <form action="{{ route('offers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Property</label>
                <select name="property_id" required class="w-full border rounded p-2">
                    @foreach($properties as $id => $address)
                        <option value="{{ $id }}">{{ $address }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Client</label>
                <select name="client_id" required class="w-full border rounded p-2">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Price (€)</label>
                <input type="number" name="price" step="0.01" required class="w-full border rounded p-2">
            </div>

            <div>
                <label>Notes</label>
                <textarea name="notes" class="w-full border rounded p-2"></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Send Offer</button>
        </form>
    </section>
@endsection
