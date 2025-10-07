<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.366-.446.957-.7 1.57-.7s1.204.254 1.57.7l5.857 7.143A2 2 0 0117 11.571V16a2 2 0 01-2 2H5a2 2 0 01-2-2v-4.429a2 2 0 01-.254-1.329l5.857-7.143zM10 12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once you delete your account, all your data will be permanently removed. Please make sure you’ve saved any important information before continuing.') }}
        </p>
    </header>

    {{-- Delete Button --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg"
    >
        <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ __('Delete Account') }}
        </span>
    </x-danger-button>

    {{-- Confirmation Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900 mb-2">
                {{ __('Are you absolutely sure?') }}
            </h2>

            <p class="text-sm text-gray-600 leading-relaxed">
                {{ __('Once your account is deleted, there is no going back. Please enter your password to confirm this action.') }}
            </p>

            {{-- Password --}}
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg"
                    placeholder="{{ __('Enter your password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg">
                    {{ __('Delete Permanently') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
