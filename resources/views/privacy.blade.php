@extends('layouts.app')

@section('fullwidth')
    <section class="relative bg-gray-900 pt-32 pb-24 w-full overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=2000"
                 class="w-full h-full object-cover opacity-30" alt="Privacy Background">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-gray-900"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight">Privacy Policy</h1>
            <p class="text-gray-300 font-light text-xl max-w-2xl">
                Your trust is our most important asset. Learn how we protect your data.
            </p>
        </div>
    </section>

    <section class="bg-white py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-16">

                <div class="hidden md:block">
                    <div class="sticky top-24 space-y-4">
                        <h4 class="text-sm font-bold uppercase tracking-widest text-gray-400">Sections</h4>
                        <nav class="flex flex-col gap-3">
                            <a href="#collection" class="text-blue-600 font-semibold hover:underline">Data Collection</a>
                            <a href="#usage" class="text-gray-600 hover:text-blue-600 transition">How We Use It</a>
                            <a href="#sharing" class="text-gray-600 hover:text-blue-600 transition">Data Sharing</a>
                            <a href="#security" class="text-gray-600 hover:text-blue-600 transition">Security Measures</a>
                        </nav>
                    </div>
                </div>

                <div class="md:col-span-2 prose prose-blue max-w-none text-gray-600">
                    <p class="mb-8 italic text-gray-400">Last Updated: March 28, 2026</p>

                    <h2 id="collection" class="text-2xl font-bold text-gray-900 mb-4">1. Information We Collect</h2>
                    <p class="mb-6">
                        When you use our RealEstate platform, we collect information that identifies you, such as your name,
                        email address, and phone number when you register or inquire about a property.
                    </p>

                    <h2 id="usage" class="text-2xl font-bold text-gray-900 mb-4">2. How We Use Your Information</h2>
                    <p class="mb-4">We use your data to:</p>
                    <ul class="list-disc ml-6 mb-8 space-y-2">
                        <li>Facilitate property viewings and offers.</li>
                        <li>Communicate with you regarding listing updates.</li>
                        <li>Improve our platform's search and recommendation features.</li>
                    </ul>

                    <h2 id="sharing" class="text-2xl font-bold text-gray-900 mb-4">3. Sharing with Third Parties</h2>
                    <p class="mb-6">
                        We only share your information with verified agents and agencies when you explicitly request a
                        viewing or submit an offer. We never sell your personal data to marketing firms.
                    </p>

                    <h2 id="security" class="text-2xl font-bold text-gray-900 mb-4">4. Data Security</h2>
                    <p class="mb-12">
                        Your information is stored on secure servers and encrypted using industry-standard protocols.
                        We regularly audit our systems to ensure your data remains protected against unauthorized access.
                    </p>

                    <div class="bg-blue-50 p-8 rounded-2xl border border-blue-100">
                        <h3 class="text-blue-900 font-bold mb-2">Have Questions?</h3>
                        <p class="text-blue-800 text-sm">
                            If you have any questions regarding our privacy practices, please reach out via our
                            <a href="{{ route('contact-us.index') }}" class="font-bold underline">Contact Page</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
