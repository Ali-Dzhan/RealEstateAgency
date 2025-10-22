@php
    $isEdit = isset($property);
@endphp

<form action="{{ $isEdit ? route('properties.update', $property->id) : route('properties.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PATCH')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Address -->
        <div>
            <label for="address" class="block font-semibold mb-2">Address</label>
            <input type="text" name="address" id="address"
                   value="{{ old('address', $property->address ?? '') }}"
                   class="w-full border rounded-lg p-3" required>
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="block font-semibold mb-2">Price (€)</label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $property->price ?? '') }}"
                   class="w-full border rounded-lg p-3" required>
        </div>

        <!-- Property Type -->
        <div>
            <label for="property_type_id" class="block font-semibold mb-2">Type</label>
            <select name="property_type_id" id="property_type_id" class="w-full border rounded-lg p-3" required>
                <option value="" disabled>Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}"
                        {{ old('property_type_id', $property->property_type_id ?? '') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Region -->
        <div>
            <label for="region_id" class="block font-semibold mb-2">Region</label>
            <select name="region_id" id="region_id" class="w-full border rounded-lg p-3" required>
                <option value="" disabled>Select Region</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ old('region_id', $property->region_id ?? '') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Area -->
        <div>
            <label for="area" class="block font-semibold mb-2">Area (m²)</label>
            <input type="number" name="area" id="area"
                   value="{{ old('area', $property->area ?? '') }}" class="w-full border rounded-lg p-3" required>
        </div>

        <!-- Rooms -->
        <div>
            <label for="rooms" class="block font-semibold mb-2">Rooms</label>
            <input type="number" name="rooms" id="rooms"
                   value="{{ old('rooms', $property->rooms ?? '') }}" class="w-full border rounded-lg p-3">
        </div>

        <!-- Agent (only admin) -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div>
                    <label for="agent_id" class="block font-semibold mb-2">Assign Agent</label>
                    <select name="agent_id" id="agent_id" class="w-full border rounded-lg p-3" required>
                        <option value="" disabled>Select Agent</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}"
                                {{ old('agent_id', $property->agent_id ?? '') == $agent->id ? 'selected' : '' }}>
                                {{ $agent->first_name }} {{ $agent->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endauth

        <!-- Photos -->
        <div class="md:col-span-2">
            <label for="photos" class="block font-semibold mb-2">Property Photos</label>
            <input type="file" name="photos[]" id="photos" multiple accept="image/*" class="w-full border rounded-lg p-3">
        </div>
    </div>

    <!-- Submit + Go Back -->
    <div class="mt-6 flex space-x-4">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg">
            {{ $isEdit ? 'Update Property' : 'Add Property' }}
        </button>

        <a href="{{ route('properties.index') }}"
           class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg">
            Go Back
        </a>
    </div>
</form>

