@extends('layouts.app')

@section('content')
    <section class="py-12 px-6 md:px-12 max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">Edit Property</h1>

        <!-- Form -->
        @include('properties.partials.form')
    </section>
@endsection
