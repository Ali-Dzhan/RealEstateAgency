<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request) {
        $query = Property::with(['agent', 'region', 'type']);

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

        $properties = $query->orderBy('created_at', 'desc')->get();

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
}
