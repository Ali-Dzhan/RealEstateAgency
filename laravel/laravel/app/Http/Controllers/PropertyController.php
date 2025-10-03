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
            $query->where('type_id', $request->type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $properties = $query->orderBy('created_at', 'desc')->get();

        return view('properties.index', compact('properties'));
    }

    public function home() {
        $featured = Property::with('agent')->inRandomOrder()->take(3)->get();
        $types = PropertyType::all();

        return view('home', compact('featured', 'types'));
    }

    public function show($id) {
        $property = Property::with('agent')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function create() {

    }
}
