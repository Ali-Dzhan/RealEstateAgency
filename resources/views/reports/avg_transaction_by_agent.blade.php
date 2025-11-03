@extends('layouts.app')
@section('content')
    <section class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6">Average Transaction Value by Agent</h1>
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-600 font-semibold text-left">
            <tr>
                <th class="px-4 py-2">Agent Name</th>
                <th class="px-4 py-2">Average Transaction (€)</th>
                <th class="px-4 py-2">Number of Transactions</th>
                <th class="px-4 py-2">Max Transaction (€)</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($data as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $row->first_name }} {{ $row->last_name }}</td>
                    <td class="px-4 py-2">{{ number_format($row->avg_value, 2) }}</td>
                    <td class="px-4 py-2">{{ $row->total_transactions }}</td>
                    <td class="px-4 py-2">{{ number_format($row->max_value, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
