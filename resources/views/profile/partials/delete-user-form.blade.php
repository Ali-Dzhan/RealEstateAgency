<section class="space-y-6">
    {{-- Header --}}
    <header class="border-b border-red-100 pb-5">
        <div class="flex items-start gap-4">

            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-trash text-red-600 text-lg"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    {{ __('Delete Account') }}
                </h2>

                <p class="mt-2 text-sm text-gray-500 leading-relaxed max-w-xl">
                    {{ __('Once you delete your account, all your data will be permanently removed. Please make sure you’ve saved any important information before continuing.') }}
                </p>
            </div>

        </div>
    </header>

    {{-- Warning Box --}}
    <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
        <div class="flex gap-3">

            <div class="mt-0.5">
                <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
            </div>

            <div>
                <h3 class="font-semibold text-red-700">
                    Permanent Action
                </h3>

                <p class="text-sm text-red-600 mt-1 leading-relaxed">
                    Deleting your account will remove all profile data, saved information,
                    and associated activity permanently.
                </p>
            </div>

        </div>
    </div>

    {{-- Delete Button --}}
    <div>
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold px-6 py-3 rounded-2xl transition duration-200 shadow-lg shadow-red-200 flex items-center gap-3"
        >
            <i class="fa-solid fa-trash-can"></i>

            {{ __('Delete Account') }}
        </x-danger-button>
    </div>

    {{-- Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-6 sm:p-8 bg-white rounded-3xl">

            @csrf
            @method('delete')

            {{-- Modal Header --}}
            <div class="flex items-start gap-4 mb-6">

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-trash-can text-red-600 text-xl"></i>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ __('Delete Account?') }}
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        {{ __('This action cannot be undone. Please enter your password to permanently delete your account.') }}
                    </p>
                </div>

            </div>

            {{-- Password --}}
            <div>
                <x-input-label
                    for="password"
                    :value="__('Confirm Password')"
                    class="font-semibold text-gray-700"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:border-red-500 focus:ring-red-500"
                    placeholder="{{ __('Enter your password') }}"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />
            </div>

            {{-- Actions --}}
            <div class="mt-8 flex flex-col-reverse sm:flex-row justify-end gap-3">

                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="w-full sm:w-auto justify-center px-5 py-3 rounded-2xl border border-gray-200 bg-gray-100 hover:bg-gray-200 text-gray-700"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button
                    class="w-full sm:w-auto justify-center bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl shadow-lg shadow-red-200"
                >
                    <i class="fa-solid fa-trash-can mr-2"></i>

                    {{ __('Delete Permanently') }}
                </x-danger-button>

            </div>

        </form>
    </x-modal>
</section>
