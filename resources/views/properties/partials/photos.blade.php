@if($property->photos->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($property->photos as $photo)
            <img src="{{ asset('storage/' . $photo->path) }}"
                 alt="Property photo"
                 class="w-full h-64 object-cover rounded-xl shadow-lg">
        @endforeach
    </div>
@else
    <img src="{{ asset('images/default.png') }}"
         alt="Property"
         class="w-full h-64 object-cover rounded-xl shadow-lg">
@endif
