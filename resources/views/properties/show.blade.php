@extends('layouts.app')

@section('content')
    <section class="bg-slate-50 min-h-screen py-12 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Breadcrumbs / Back Button --}}
            <div class="mb-6">
                <a href="{{ route('properties.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Back to Properties
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT COLUMN: Content & Media (70%) --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Hero Gallery --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="grid grid-cols-4 grid-rows-2 gap-2 h-[500px]">

                            @php
                                $photos = $property->photos->values();

                                $defaultPhoto = asset('images/default.png');

                                $fillerPhotos = [
                                    'https://images.unsplash.com/photo-1600607687644-c7171b42498f?auto=format&fit=crop&w=900&q=80',
                                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=900&q=80',
                                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=900&q=80',
                                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=900&q=80',
                                ];

                                $photo1 = isset($photos[0]) ? asset($photos[0]->path) : $defaultPhoto;
                                $photo2 = isset($photos[1]) ? asset($photos[1]->path) : $fillerPhotos[array_rand($fillerPhotos)];
                                $photo3 = isset($photos[2]) ? asset($photos[2]->path) : $fillerPhotos[array_rand($fillerPhotos)];
                            @endphp

                            {{-- Main Large Image --}}
                            <div class="col-span-4 md:col-span-3 row-span-2 relative group overflow-hidden">
                                <img src="{{ $photo1 }}"
                                     class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                                <div class="absolute top-4 left-4">
                <span class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg">
                    {{ $property->type->name }}
                </span>
                                </div>
                            </div>

                            {{-- Secondary Image 1 --}}
                            <div class="hidden md:block col-span-1 row-span-1 overflow-hidden">
                                <img src="{{ $photo2 }}"
                                     class="w-full h-full object-cover hover:opacity-90 cursor-pointer transition">
                            </div>

                            {{-- Secondary Image 2 --}}
                            <div class="hidden md:block col-span-1 row-span-1 overflow-hidden">
                                <img src="{{ $photo3 }}"
                                     class="w-full h-full object-cover hover:opacity-90 cursor-pointer transition">
                            </div>

                        </div>
                    </div>

                    {{-- Property Header & Features --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
                        <div class="flex flex-col md:flex-row justify-between items-start mb-6 gap-4">
                            <div>
                                <h1 class="text-4xl font-black text-slate-900 leading-tight mb-2">{{ $property->address }}</h1>
                                <p class="text-slate-500 flex items-center gap-2 text-lg">
                                    <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $property->region->name }}
                                </p>
                            </div>
                            <div class="md:text-right">
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Asking Price</p>
                                <p class="text-4xl font-black text-blue-600">€{{ number_format($property->price, 0) }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-t border-slate-100 pt-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fa-solid fa-bed text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">Rooms</p>
                                    <p class="font-bold text-slate-800 text-lg">{{ $property->rooms ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fa-solid fa-ruler-combined text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">Area</p>
                                    <p class="font-bold text-slate-800 text-lg">{{ $property->area }} m²</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fa-solid fa-building text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">Status</p>
                                    <p class="font-bold {{ $property->status === 'available' ? 'text-green-600' : 'text-red-600' }} text-lg">
                                        {{ ucfirst($property->status) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fa-solid fa-tags text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">Type</p>
                                    <p class="font-bold text-slate-800 text-lg">{{ $property->type->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description Section --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">About this property</h2>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                            {{ $property->description ?? 'No detailed description provided for this listing.' }}
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Sidebar (30%) --}}
                <div class="lg:col-span-1 space-y-6">

                    <div class="sticky top-8 space-y-6">

                        {{-- Booking Card --}}
                        <div class="bg-white rounded-3xl p-8 border-blue-50 ring-4 ring-blue-50/50">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Schedule a Tour</h3>
                            <p class="text-slate-500 text-sm mb-6">Choose your preferred date and we'll confirm within 24h.</p>

                            <form action="{{ route('viewings.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">

                                <div>
                                    <label class="text-xs font-black uppercase text-slate-400 mb-2 block">
                                        Visit Date & Time
                                    </label>

                                    <input type="datetime-local" name="scheduled_on"
                                           class="w-full rounded-2xl border-slate-200 bg-slate-50 p-4"
                                           required>

                                    @if(session('success'))
                                        <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-xl mb-4 mt-4">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @error('scheduled_on')
                                    <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mb-4 mt-4">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-lg shadow-lg shadow-blue-200 transition-all active:scale-95 disabled:bg-slate-200 disabled:shadow-none"
                                        @unless($property->status === 'available' && auth()->check() && auth()->user()->role === 'client') disabled @endunless>
                                    Book Viewing Now
                                </button>

                                @if(!auth()->check() || auth()->user()->role !== 'client')
                                    <div class="bg-amber-50 rounded-xl p-3 flex items-center gap-3 mt-4">
                                        <i class="fa-solid fa-circle-info text-amber-600"></i>
                                        <p class="text-[11px] text-amber-800 font-medium leading-tight">
                                            Log in as a client to book.
                                        </p>
                                    </div>
                                @endif
                            </form>
                        </div>

                        {{-- Lighter Agent Card --}}
                        <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 shadow-sm">
                            <p class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-4">Listed By</p>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                                    {{ substr($property->agent->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-slate-900">{{ $property->agent->first_name }} {{ $property->agent->last_name }}</h4>
                                    <p class="text-slate-500 text-sm">Professional Agent</p>
                                </div>
                            </div>

                            <div class="space-y-4 pt-4 border-t border-slate-200">
                                <a href="mailto:{{ $property->agent->email }}" class="flex items-center gap-3 text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-envelope text-blue-500 w-5"></i>
                                    <span class="text-sm">{{ $property->agent->email }}</span>
                                </a>
                                <a href="tel:{{ $property->agent->phone }}" class="flex items-center gap-3 text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-phone text-blue-500 w-5"></i>
                                    <span class="text-sm font-medium">{{ $property->agent->phone }}</span>
                                </a>
                            </div>

                            {{-- Admin Actions --}}
                            @auth
                                @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'agent' && $property->agent_id === auth()->user()->agent->id))
                                    <div class="grid grid-cols-2 gap-3 mt-8">
                                        <a href="{{ route('properties.edit', $property->id) }}"
                                           class="bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 text-center py-3 rounded-xl text-xs font-bold transition shadow-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Delete this listing?')" class="w-full bg-white border border-red-100 hover:bg-red-50 text-red-600 py-3 rounded-xl text-xs font-bold transition shadow-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
