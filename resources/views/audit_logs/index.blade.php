@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto py-10 px-6">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Audit Logs</h1>

            <table class="min-w-full border border-gray-200 rounded-lg text-sm text-center">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Action</th>
                    <th class="px-4 py-3">Entity</th>
                    <th class="px-4 py-3">Record ID</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ $log->user->username ?? 'Deleted User' }}</td>
                        <td class="px-4 py-2 font-semibold text-blue-600">{{ ucfirst($log->action) }}</td>
                        <td class="px-4 py-2">{{ ucfirst($log->entity) }}</td>
                        <td class="px-4 py-2">#{{ $log->entity_id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $logs->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
@endsection

