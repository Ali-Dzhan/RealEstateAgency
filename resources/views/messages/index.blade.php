@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Client Inquiries</h1>
            <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">
            Total: {{ $messages->total() }}
        </span>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 font-bold text-gray-700">Date</th>
                    <th class="p-4 font-bold text-gray-700">Sender</th>
                    <th class="p-4 font-bold text-gray-700">Subject</th>
                    <th class="p-4 font-bold text-gray-700">Message</th>
                    <th class="p-4 font-bold text-gray-700 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $msg)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-gray-500">{{ $msg->created_at->format('M d, Y') }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900">{{ $msg->name }}</div>
                            <div class="text-xs text-gray-500">{{ $msg->email }}</div>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-md text-xs font-bold uppercase
                                {{ $msg->subject == 'buying' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $msg->subject }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-gray-600 max-w-xs truncate">
                            {{ $msg->message }}
                        </td>
                        <td class="p-4 text-right">
                            <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-400 italic">
                            No inquiries found yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
