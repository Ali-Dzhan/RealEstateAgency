<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index() {
        $properties = Property::with(['agent', 'region', 'type'])->get();
        return view('properties.index', compact('properties'));
    }
}
