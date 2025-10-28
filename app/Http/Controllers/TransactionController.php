<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'agent') {
            $transactions = Transaction::whereHas('offer', fn($q) => $q->where('agent_id', $user->agent->id))
                ->with('offer.property','offer.client')->latest()->paginate(15);
        } elseif ($user->role === 'client') {
            $transactions = Transaction::whereHas('offer', fn($q) => $q->where('client_id', $user->client->id))
                ->with('offer.property','offer.agent')->latest()->paginate(15);
        } else {
            $transactions = Transaction::with('offer.property','offer.agent','offer.client')->latest()->paginate(20);
        }

        return view('transactions.index', compact('transactions'));
    }
}
