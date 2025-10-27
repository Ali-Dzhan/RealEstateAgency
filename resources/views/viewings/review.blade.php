@extends('layouts.app')

@section('content')
    <section class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Leave a Review</h1>

        <form action="{{ route('viewings.update', $viewing->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-gray-700 font-medium mb-1">Your Rating (1–5)</label>
                <input type="number" name="rating" min="1" max="5" value="{{ $viewing->rating ?? 5 }}" class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Your Review</label>
                <textarea name="client_review" rows="5" class="w-full border rounded-lg p-2">{{ $viewing->client_review }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Submit Review</button>
        </form>
    </section>
@endsection
