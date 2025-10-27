@extends('layouts.app')

@section('content')
    <section class="py-16 px-6 md:px-12">
        <h1 class="text-3xl font-bold text-center mb-12">Agents</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">First Name</th>
                    <th class="py-3 px-6 text-left">Last Name</th>
                    <th class="py-3 px-6 text-left">Phone</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($agents as $index => $agent)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $agent->first_name }}</td>
                        <td class="py-3 px-6">{{ $agent->last_name }}</td>
                        <td class="py-3 px-6">{{ $agent->phone }}</td>
                        <td class="py-3 px-6">{{ $agent->email }}</td>
                        <td class="py-3 px-6 text-center flex justify-center gap-2">
                            <a href="{{ route('agents.edit', $agent->id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <form action="{{ route('agents.destroy', $agent->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this agent?');">
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
                        <td colspan="6" class="py-6 text-center text-gray-500">No agents found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $agents->links() }}
        </div>
    </section>
@endsection
