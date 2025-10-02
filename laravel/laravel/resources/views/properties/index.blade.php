@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">All Properties</h1>
    <ul class="space-y-2">
        @foreach($properties as $property)
            <li>
                {{ $property->type }} at {{ $property->address }} in {{ $property->region->name }}
                — Agent: {{ $property->agent->first_name }} {{ $property->agent->last_name }}
                — Price: {{ $property->price }} €
                — Area: {{ $property->area }} m²
                — Rooms: {{ $property->rooms }}
                — Status: {{ ucfirst($property->status) }}
            </li>
        @endforeach
    </ul>
@endsection
