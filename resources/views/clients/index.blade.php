@extends('layouts.app')

@section('content')
    <section class="py-16 px-6 md:px-12">
        <h1 class="text-3xl font-bold text-center mb-12">Clients</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Phone</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($clients as $index => $client)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $client->name }}</td>
                        <td class="py-3 px-6">{{ $client->phone }}</td>
                        <td class="py-3 px-6">{{ $client->email }}</td>
                        <td class="py-3 px-6 text-center flex justify-center gap-2">
                            <a href="{{ route('clients.edit', $client->id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">No clients found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
