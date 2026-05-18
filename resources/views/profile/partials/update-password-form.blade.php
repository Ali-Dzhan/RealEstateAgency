<section class="space-y-6">
    {{-- Header --}}
    <header class="border-b border-blue-100 pb-5">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-shield-halved text-blue-600 text-lg"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    {{ __('Update Password') }}
                </h2>

                <p class="mt-2 text-sm text-gray-500 leading-relaxed max-w-xl">
                    {{ __('Keep your account secure by using a strong and unique password.') }}
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" class="font-semibold text-gray-700" />

            <x-text-input
                id="current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                autocomplete="current-password"
                placeholder="{{ __('Enter your current password') }}"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />
        </div>

        {{-- New Password --}}
        <div>
            <x-input-label for="password" :value="__('New Password')" class="font-semibold text-gray-700" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                autocomplete="new-password"
                placeholder="{{ __('Enter a new password') }}"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="font-semibold text-gray-700" />

            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                autocomplete="new-password"
                placeholder="{{ __('Confirm your new password') }}"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        {{-- Tip --}}
        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-info text-blue-500 mt-0.5"></i>

                <p class="text-sm text-blue-700 leading-relaxed">
                    Use at least 8 characters with a mix of letters, numbers, and symbols for better security.
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pt-2">
            <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-200">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-medium text-green-600 flex items-center gap-2"
                >
                    <i class="fa-solid fa-circle-check"></i>
                    {{ __('Password updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>
