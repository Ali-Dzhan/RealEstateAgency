<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Property;
use App\Models\Client;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'agent') {
            $offers = Offer::where('agent_id', $user->agent->id)->with('property','client','transactions')->latest()->paginate(3);
        } elseif ($user->role === 'client') {
            $offers = Offer::where('client_id', $user->client->id)->with('property','agent','transactions')->latest()->paginate(3);
        } else {
            $offers = Offer::with('property','agent','client','transactions')->latest()->paginate(3);
        }
        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'agent') abort(403);

        $properties = $user->agent->properties()
            ->where('status', 'available')
            ->pluck('address','id');

        $clients = Client::orderBy('name')->get();
        return view('offers.create', compact('properties','clients'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'agent') abort(403);

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'client_id' => 'required|exists:clients,id',
            'price' => 'required|numeric|min:0',
            'signed_on' => 'nullable|date',
            'notes' => 'nullable|string|max:2000',
        ]);

        $property = Property::find($request->property_id);

        if ($property->agent_id !== $user->agent->id) abort(403);
        if ($property->status !== 'available') {
            return redirect()->back()->withErrors('This property is not available for offers.');
        }

        $offer = Offer::create([
            'property_id' => $property->id,
            'agent_id' => $user->agent->id,
            'client_id' => $request->client_id,
            'signed_on' => $request->signed_on ?? Carbon::today(),
            'price' => $request->price,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        $offer->property()->update(['status' => 'reserved']);

        return redirect()->route('offers.index')
            ->with('success','Offer created. Property reserved.');
    }

    // client accepts — create a transaction
    public function accept(Offer $offer)
    {
        $user = Auth::user();
        if ($user->role !== 'client' || $offer->client_id !== $user->client->id) abort(403);
        if ($offer->status !== 'pending') return back()->withErrors('Offer is not pending.');

        $offer->update(['status' => 'accepted']);

        $tx = Transaction::create([
            'offer_id' => $offer->id,
            'amount' => $offer->price,
            'payment_method' => 'manual',
            'status' => 'completed',
            'paid_at' => now(),
            'reference' => 'AUTO-' . strtoupper(uniqid()),
        ]);

        $offer->property()->update(['status' => 'sold']);

        return redirect()->route('offers.index')->with('success','Offer accepted and transaction recorded.');
    }

    // client rejects
    public function reject(Offer $offer)
    {
        $user = Auth::user();
        if ($user->role !== 'client' || $offer->client_id !== $user->client->id) abort(403);
        if ($offer->status !== 'pending') return back()->withErrors('Offer is not pending.');

        $offer->update(['status' => 'rejected']);
        return redirect()->route('offers.index')->with('success','Offer rejected.');
    }

    // optional show
    public function show(Offer $offer)
    {
        $user = Auth::user();
        if ($user->role === 'agent' && $offer->agent_id !== $user->agent->id) abort(403);
        if ($user->role === 'client' && $offer->client_id !== $user->client->id) abort(403);

        $offer->load('property','agent','client','transactions');
        return view('offers.show', compact('offer'));
    }

    // history of changes
    public function history(Offer $offer)
    {
        $user = auth()->user();

        // ACL
        if ($user->role === 'admin') {
            $histories = $offer->histories()->with('user')->latest()->get();
        } elseif ($user->role === 'agent') {
            $histories = $offer->histories()->with('user')->latest()->get();
        } else {
            abort(403, 'Unauthorized access.');
        }

        return view('offers.history', compact('offer', 'histories'));
    }
}
