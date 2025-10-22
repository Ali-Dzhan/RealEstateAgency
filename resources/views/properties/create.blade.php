@extends('layouts.app')

@section('content')
    <section class="py-16 px-6 md:px-12 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Add New Property</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-8 rounded-xl shadow-lg space-y-6">
            @csrf

            <!-- Address -->
            <div>
                <label for="address" class="block font-semibold mb-2">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}"
                       class="w-full border rounded-lg p-3" required>
            </div>

            <!-- Type -->
            <div>
                <label for="property_type_id" class="block font-semibold mb-2">Property Type</label>
                <select name="property_type_id" id="property_type_id" class="w-full border rounded-lg p-3" required>
                    <option value="" disabled selected>Select type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('property_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{--Region--}}
            <label for="region_id" class="block font-semibold mb-2">Region / City</label>
            <select name="region_id" id="region_id" class="w-full border rounded-lg p-3" required>
                <option value="" disabled selected>Select a region</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>

            @auth
                @if(auth()->user()->role === 'admin')
                    <div>
                        <label for="agent_id" class="block font-semibold mb-2">Assign Agent</label>
                        <select name="agent_id" id="agent_id" class="w-full border rounded-lg p-3" required>
                            <option value="" disabled selected>Select an agent</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->first_name }} {{ $agent->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endauth

            <!-- Price -->
            <div>
                <label for="price" class="block font-semibold mb-2">Price (€)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                       class="w-full border rounded-lg p-3" required>
            </div>

            <!-- Rooms -->
            <div>
                <label for="rooms" class="block font-semibold mb-2">Rooms</label>
                <input type="number" name="rooms" id="rooms" value="{{ old('rooms') }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <!-- Area -->
            <div>
                <label for="area" class="block font-semibold mb-2">Area (m²)</label>
                <input type="number" name="area" id="area" value="{{ old('area') }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <!-- Photos -->
            <div>
                <label for="photos" class="block font-semibold mb-2">Property Photos</label>
                <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                       class="w-full border rounded-lg p-3">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg">
                    Add Property
                </button>
            </div>
        </form>
    </section>
@endsection

