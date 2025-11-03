@extends('layouts.app')
@section('content')
    <section class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-6">Monthly Transaction Summary</h1>

        <form method="GET" class="mb-6 flex gap-4">
            <input type="date" name="start_date" value="{{ $start }}" class="border p-2 rounded">
            <input type="date" name="end_date" value="{{ $end }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-600 font-semibold text-left">
            <tr>
                <th class="px-4 py-2">Month</th>
                <th class="px-4 py-2">Total Revenue (€)</th>
                <th class="px-4 py-2">Number of Transactions</th>
                <th class="px-4 py-2">Average Transaction (€)</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($data as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $row->month }}</td>
                    <td class="px-4 py-2">{{ number_format($row->total_revenue, 2) }}</td>
                    <td class="px-4 py-2">{{ $row->total_transactions }}</td>
                    <td class="px-4 py-2">{{ number_format($row->avg_value, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
