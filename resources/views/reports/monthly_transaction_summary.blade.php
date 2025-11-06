@extends('layouts.app')
@section('content')
    <section class="max-w-6xl mx-auto py-12 px-6">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Monthly Transaction Summary</h1>

            <a href="{{ route('reports.monthly_transaction_summary.export') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                Export CSV
            </a>
        </div>

        <form method="GET" class="flex flex-wrap items-center gap-3 mb-8">
            <input type="date" name="start_date" value="{{ $start }}" class="border p-2 rounded w-40">
            <input type="date" name="end_date" value="{{ $end }}" class="border p-2 rounded w-40">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Filter
            </button>
        </form>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">Month</th>
                        <th class="px-4 py-3 text-right">Total Revenue (€)</th>
                        <th class="px-4 py-3">Transactions</th>
                        <th class="px-4 py-3 text-right">Average (€)</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 text-gray-800">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-left">{{ $row->month }}</td>
                            <td class="px-4 py-3 text-right font-semibold">{{ number_format($row->total_revenue, 2) }}</td>
                            <td class="px-4 py-3">{{ $row->total_transactions }}</td>
                            <td class="px-4 py-3 text-right">{{ number_format($row->avg_value, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </section>
@endsection
