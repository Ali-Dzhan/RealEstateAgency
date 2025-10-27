@extends('layouts.app')

@section('content')
    <section class="max-w-3xl mx-auto py-10 px-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Update Viewing</h1>
            <a href="{{ route('viewings.index') }}"
               class="text-gray-600 hover:text-gray-800 flex items-center gap-1">
                &larr; Go Back
            </a>
        </div>

        <div class="bg-white shadow-md rounded-2xl p-8">
            <form action="{{ route('viewings.update', $viewing->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" id="status" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="pending" {{ $viewing->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $viewing->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $viewing->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="agent_notes" class="block text-gray-700 font-medium mb-2">Agent Notes</label>
                    <textarea name="agent_notes" id="agent_notes" rows="5" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Add notes about this viewing...">{{ old('agent_notes', $viewing->agent_notes) }}</textarea>
                    @error('agent_notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('viewings.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
