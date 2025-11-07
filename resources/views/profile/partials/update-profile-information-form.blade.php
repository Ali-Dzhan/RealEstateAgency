<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account information below.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Username (required) --}}
        <div>
            <x-input-label for="username" :value="__('Username')"/>
            <x-text-input id="username" name="username" type="text"
                          class="mt-1 block w-full"
                          :value="old('username', $user->username)"
                          required autofocus autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('username')"/>
        </div>

        {{-- Email (optional) --}}
        <div>
            <x-input-label for="email" :value="__('Email (optional)')"/>
            <x-text-input id="email" name="email" type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $user->email)"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        {{-- Agent fields --}}
        @if ($user->role === 'agent')
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="first_name" :value="__('First Name (optional)')"/>
                    <x-text-input id="first_name" name="first_name" type="text"
                                  class="mt-1 block w-full"
                                  :value="old('first_name', optional($user->agent)->first_name)"/>
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name (optional)')"/>
                    <x-text-input id="last_name" name="last_name" type="text"
                                  class="mt-1 block w-full"
                                  :value="old('last_name', optional($user->agent)->last_name)"/>
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
                </div>
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone (optional)')"/>
                <x-text-input id="phone" name="phone" type="text"
                              class="mt-1 block w-full"
                              :value="old('phone', optional($user->agent)->phone)"/>
                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
            </div>
        @endif

        {{-- Client fields --}}
        @if ($user->role === 'client')
            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name (optional)')"/>
                    <x-text-input id="name" name="name" type="text"
                                  class="mt-1 block w-full"
                                  :value="old('name', optional($user->client)->name)"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone (optional)')"/>
                    <x-text-input id="phone" name="phone" type="text"
                                  class="mt-1 block w-full"
                                  :value="old('phone', optional($user->client)->phone)"/>
                    <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                </div>
            </div>
        @endif

        {{-- Submit --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
