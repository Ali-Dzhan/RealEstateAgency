@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Transactions</h1>

        @forelse($transactions as $tx)
            <div class="bg-white p-4 rounded shadow mb-3 flex justify-between">
                <div>
                    <div class="font-semibold">{{ $tx->offer->property->address ?? '—' }}</div>
                    <div class="text-sm text-gray-600">Offer: {{ number_format($tx->offer->price,2) }} € • Paid: {{ number_format($tx->amount,2) }} €</div>
                    <div class="text-sm text-gray-600">Method: {{ $tx->payment_method }} • Status: {{ ucfirst($tx->status) }}</div>
                </div>

                <div class="text-right">
                    <div class="text-sm">{{ $tx->paid_at ? $tx->paid_at->format('d M Y H:i') : '—' }}</div>
                    <div class="text-xs text-gray-500">{{ $tx->reference }}</div>
                </div>
            </div>
        @empty
            <p>No transactions.</p>
        @endforelse

        <div class="mt-6">{{ $transactions->links() }}</div>
    </section>
@endsection
