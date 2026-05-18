@extends('layouts.app')

@section('content')
    <div class="bg-gray-50/70 min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans antialiased">
        <div class="max-w-6xl mx-auto">

            {{-- Header Section --}}
            <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-gray-200/60">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-gray-900 sm:text-4xl">
                        Profile Settings
                    </h1>
                    <p class="mt-2 text-base text-gray-500">
                        Manage your account details, security preferences, and data.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Left Navigation / Info Sidebar --}}
                <aside class="lg:col-span-1 lg:sticky lg:top-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 space-y-6">

                        {{-- User Intro Mini-Card --}}
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0 border border-blue-100/50">
                                <i class="fa-solid fa-user-gear text-xl text-blue-600"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 leading-tight">
                                    Account Center
                                </h2>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    Personalize your experience
                                </p>
                            </div>
                        </div>

                        {{-- Interactive Sidebar Navigation Links --}}
                        {{-- Note: If you want these to anchor link to the forms, you can add IDs to the form wrappers (e.g., href="#profile-info") --}}
                        <nav class="space-y-1">
                            <a href="#profile-info" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl text-gray-700 bg-gray-50 border border-gray-200/50 transition-all duration-200">
                                <i class="fa-solid fa-id-card text-blue-500 w-5 text-center"></i>
                                <span>Profile information</span>
                            </a>

                            <a href="#password-security" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl text-gray-500 hover:text-gray-900 hover:bg-gray-50/80 transition-all duration-200 group">
                                <i class="fa-solid fa-shield-halved text-gray-400 group-hover:text-blue-500 w-5 text-center transition-colors"></i>
                                <span>Password security</span>
                            </a>

                            <a href="#danger-zone" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl text-gray-500 hover:text-red-600 hover:bg-red-50/50 transition-all duration-200 group">
                                <i class="fa-solid fa-trash-can text-gray-400 group-hover:text-red-500 w-5 text-center transition-colors"></i>
                                <span>Account deletion</span>
                            </a>
                        </nav>

                        {{-- Small Security Badge --}}
                        <div class="bg-blue-50/40 rounded-xl p-3.5 border border-blue-100/40 text-center">
                            <p class="text-xs text-blue-700/80 font-medium flex items-center justify-center gap-2">
                                <i class="fa-solid fa-lock-open"></i> End-to-end data encryption active
                            </p>
                        </div>
                    </div>
                </aside>

                {{-- Forms Container --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Profile Info Form Block --}}
                    <div id="profile-info" class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 sm:p-8 transition-all scroll-mt-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    {{-- Password Form Block --}}
                    <div id="password-security" class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 sm:p-8 transition-all scroll-mt-8">
                        @include('profile.partials.update-password-form')
                    </div>

                    {{-- Account Deletion Block (The Danger Zone) --}}
                    <div id="danger-zone" class="bg-white rounded-2xl shadow-sm border-2 border-red-100 p-6 sm:p-8 transition-all scroll-mt-8 relative overflow-hidden">
                        {{-- Top Warning Accent Line --}}
                        <div class="absolute top-0 left-0 right-0 h-[4px] bg-gradient-to-r from-red-400 to-red-500"></div>

                        <div class="flex items-center gap-2 mb-4 text-red-600">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Danger Zone</span>
                        </div>

                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
