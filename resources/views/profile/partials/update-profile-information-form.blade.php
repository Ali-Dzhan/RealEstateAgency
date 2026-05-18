<section class="space-y-6">
    {{-- Header --}}
    <header class="border-b border-gray-100 pb-5">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">
                <i class="fa-solid fa-id-card text-blue-600 text-lg"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ __("Update your account information below.") }}
                </p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        {{-- Username --}}
        <div>
            <x-input-label for="username" :value="__('Username')" class="font-semibold text-gray-700" />

            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                :value="old('username', $user->username)"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email (optional)')" class="font-semibold text-gray-700" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                :value="old('email', $user->email)"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Agent fields --}}
        @if ($user->role === 'agent')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="first_name" :value="__('First Name (optional)')" class="font-semibold text-gray-700" />

                    <x-text-input
                        id="first_name"
                        name="first_name"
                        type="text"
                        class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                        :value="old('first_name', optional($user->agent)->first_name)"
                    />

                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name (optional)')" class="font-semibold text-gray-700" />

                    <x-text-input
                        id="last_name"
                        name="last_name"
                        type="text"
                        class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                        :value="old('last_name', optional($user->agent)->last_name)"
                    />

                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                </div>
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone (optional)')" class="font-semibold text-gray-700" />

                <x-text-input
                    id="phone"
                    name="phone"
                    type="text"
                    class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                    :value="old('phone', optional($user->agent)->phone)"
                />

                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        @endif

        {{-- Client fields --}}
        @if ($user->role === 'client')
            <div class="space-y-5">
                <div>
                    <x-input-label for="name" :value="__('Name (optional)')" class="font-semibold text-gray-700" />

                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                        :value="old('name', optional($user->client)->name)"
                    />

                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone (optional)')" class="font-semibold text-gray-700" />

                    <x-text-input
                        id="phone"
                        name="phone"
                        type="text"
                        class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                        :value="old('phone', optional($user->client)->phone)"
                    />

                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>
            </div>
        @endif

        {{-- Submit --}}
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pt-2">
            <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-200">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-medium text-green-600">
                    {{ __('Profile updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>
