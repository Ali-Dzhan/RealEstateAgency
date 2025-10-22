<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request) {
        $query = Property::with(['agent', 'region', 'type']);

        if (Auth::check() && Auth::user()->role === 'agent') {
            $query->where('agent_id' , Auth::user()->agent->id);
        }

        // Filter by location (searches in address or region name)
        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $request->location . '%')
                ->orWhereHas('region', function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->location . '%');
                });
        }

        // Filter by property type
        if ($request->filled('type')) {
            $query->where('property_type_id', $request->type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $properties = $query->orderBy('created_at', 'desc')->paginate(3);

        $types = PropertyType::all();
        return view('properties.index', compact('properties', 'types'));
    }

    public function home() {
        $featured = Property::with('agent')->inRandomOrder()->take(3)->get();
        $types = PropertyType::all();

        return view('home', compact('featured', 'types'));
    }

    public function show($id) {
        $property = Property::with('agent', 'photos', 'type', 'region')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function purchase($id)
    {
        $property = Property::findOrFail($id);

        if ($property->status !== 'available') {
            return redirect()->back()->with('error', 'This property is not available.');
        }

        // Marked as sold for testing
        $property->status = 'sold';
        $property->save();

        return redirect()->back()->with('success', 'Property marked as sold (test).');
    }

    // Agent methods
    public function create()
    {
        $types = PropertyType::all();
        $regions = Region::all();

        $agents = [];
        if (auth()->user()->role === 'admin') {
            $agents = Agent::all();
        }
        return view('properties.create', compact('types', 'agents', 'regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|numeric',
            'rooms' => 'nullable|numeric',
            'photos.*' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp,image/avif|max:2048',
            'agent_id' => auth()->user()->role === 'admin' ? 'required|exists:agents,id' : '',
        ]);

        $property = new Property([
            'address' => $request->address,
            'price' => $request->price,
            'region_id' => $request->region_id,
            'property_type_id' => $request->property_type_id,
            'area' => $request->area,
            'rooms' => $request->rooms,
        ]);

        // Assign agent
        if (auth()->user()->role === 'admin') {
            $property->agent_id = $request->agent_id;
        } else {
            $property->agent_id = auth()->user()->agent->id;
        }

        $property->status = 'available';
        $property->save();

        // Save photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('properties', 'public');
                $property->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property added successfully.');
    }

    public function edit(Property $property)
    {
        $user = auth()->user();

        // Agents can only edit their properties
        if ($user->role === 'agent' && $property->agent_id !== $user->agent->id) {
            abort(403, 'Unauthorized.');
        }

        $types = PropertyType::all();
        $regions = Region::all();
        $agents = $user->role === 'admin' ? Agent::all() : collect();

        return view('properties.edit', compact('property', 'types', 'regions', 'agents'));
    }

    public function update(Request $request, Property $property)
    {
        $user = auth()->user();
        if ($user->role === 'agent' && $property->agent_id !== $user->agent->id) {
            abort(403, 'Unauthorized.');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|numeric',
            'rooms' => 'nullable|numeric',
            'photos.*' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp,image/avif|max:2048',
            'agent_id' => auth()->user()->role === 'admin' ? 'required|exists:agents,id' : '',
        ]);

        $property->update([
            'address' => $request->address,
            'price' => $request->price,
            'region_id' => $request->region_id,
            'property_type_id' => $request->property_type_id,
            'area' => $request->area,
            'rooms' => $request->rooms,
        ]);

        if ($user->role === 'admin') {
            $property->agent_id = $request->agent_id;
            $property->save();
        }

        // Handle photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('properties', 'public');
                $property->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $user = auth()->user();
        if ($user->role === 'agent' && $property->agent_id !== $user->agent->id) {
            abort(403, 'Unauthorized.');
        }

        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
