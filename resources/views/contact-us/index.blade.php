@extends('layouts.app')

@section('fullwidth')
    <section class="relative bg-gray-900 text-white py-32">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?auto=format&fit=crop&q=80&w=2000"
                 alt="Contact Our Team"
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/60 to-gray-900"></div>
        </div>
        <div class="relative z-10 text-center px-6">
            <span class="bg-blue-600 text-white text-xs font-bold uppercase px-3 py-1 rounded-full mb-4 inline-block tracking-widest">Available 24/7</span>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight">Get in Touch</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light">
                Have a question about a listing or want to book a viewing? Our local experts are just a message away.
            </p>
        </div>
    </section>

    <section class="py-16 bg-gray-50 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-12">

                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Office Details</h3>

                        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm border border-gray-100 mb-4 hover:border-blue-300 transition">
                            <div class="text-blue-600 bg-blue-50 p-3 rounded-lg mr-4">
                                <i class="fa-solid fa-phone-volume fa-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Direct Line</p>
                                <p class="text-gray-900 font-semibold">+359 888 123 456</p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm border border-gray-100 mb-4 hover:border-blue-300 transition">
                            <div class="text-blue-600 bg-blue-50 p-3 rounded-lg mr-4">
                                <i class="fa-solid fa-envelope-open-text fa-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Support Email</p>
                                <p class="text-gray-900 font-semibold">hello@realestate.bg</p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-blue-300 transition">
                            <div class="text-blue-600 bg-blue-50 p-3 rounded-lg mr-4">
                                <i class="fa-solid fa-location-dot fa-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Headquarters</p>
                                <p class="text-gray-900 font-semibold">123 Blvd Vitosha, Sofia</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-blue-700 rounded-2xl text-white shadow-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                                <i class="fa-regular fa-clock"></i> Business Hours
                            </h4>
                            <ul class="space-y-3 opacity-90 text-sm">
                                <li class="flex justify-between border-b border-blue-500/50 pb-2">
                                    <span>Monday - Friday</span>
                                    <span>09:00 - 18:00</span>
                                </li>
                                <li class="flex justify-between border-b border-blue-500/50 pb-2">
                                    <span>Saturday</span>
                                    <span>10:00 - 14:00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span>Sunday</span>
                                    <span class="font-bold uppercase text-xs bg-blue-800 px-2 py-1 rounded">Closed</span>
                                </li>
                            </ul>
                        </div>
                        <i class="fa-solid fa-building absolute -right-4 -bottom-4 text-8xl opacity-10 rotate-12"></i>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-lg border border-gray-100">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-gray-900">Send us a Message</h3>
                            <p class="text-gray-500 mt-2">Our agents usually respond within 2-4 business hours.</p>
                        </div>

                        @if(session('success'))
                            <div class="md:col-span-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="md:col-span-2 bg-red-100 text-red-700 p-4 rounded-xl mb-6">
                                <ul class="list-disc ml-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('contact-us.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Your Full Name</label>
                                <div class="relative">
                                    <i class="fa-solid fa-user absolute left-4 top-4 text-gray-300"></i>
                                    <input type="text" name="name" required placeholder="John Doe"
                                           class="w-full pl-12 p-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50/50 focus:bg-white">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Email Address</label>
                                <div class="relative">
                                    <i class="fa-solid fa-at absolute left-4 top-4 text-gray-300"></i>
                                    <input type="email" name="email" required placeholder="john@example.com"
                                           class="w-full pl-12 p-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50/50 focus:bg-white">
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Subject of Inquiry</label>
                                <select name="subject" class="w-full p-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50/50 focus:bg-white font-medium text-gray-700">
                                    <option value="buying">I want to buy a property</option>
                                    <option value="selling">I want to list my property</option>
                                    <option value="viewing">I want to schedule a viewing</option>
                                    <option value="support">General Support / Question</option>
                                </select>
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">How can we help?</label>
                                <textarea name="message" rows="5" required placeholder="Tell us more about what you're looking for..."
                                          class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50/50 focus:bg-white"></textarea>
                            </div>

                            <button type="submit"
                                    class="md:col-span-2 bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition-all transform hover:-translate-y-1 shadow-xl shadow-blue-200 flex items-center justify-center gap-3 group">
                                <span>Send Inquiry</span>
                                <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
