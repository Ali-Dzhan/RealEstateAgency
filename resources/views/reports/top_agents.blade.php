@extends('layouts.app')

@section('content')
    <section class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Top Agents</h1>

        <table class="min-w-full border text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">#</th>
                <th class="p-2 border">Agent</th>
                <th class="p-2 border">Deals</th>
                <th class="p-2 border">Total Value (€)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $index => $agent)
                <tr>
                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $agent['first_name'] }} {{ $agent['last_name'] }}</td>
                    <td class="border p-2 text-center">{{ $agent['total_deals'] }}</td>
                    <td class="border p-2 text-right">{{ number_format($agent['total_value'], 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
