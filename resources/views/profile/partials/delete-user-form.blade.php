<section class="space-y-6">

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="row mb-3">
            <label class="col-md-6 col-lg-3 col-form-label">{{__('auth.unverify_email')}}</label>
            <div class="col-md-6 col-lg-9">
                <div class="text-center">
                    <button form="sendVerification"class="btn btn-success">{{__('auth.verify_button')}}</button>
                </div>
            </div>
        </div>    
    @endif
    
    <form id="sendVerification">
        @csrf
    </form>

    <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{__('auth._delete_account')}}</label>
        <div class="col-md-8 col-lg-9">
            <div class="text-center">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccount">{{__('auth._delete_account')}}</button>
            </div>
        </div>
    </div>

    <form id="deleteAccountForm" class="row g-3 needs-validation" novalidate>
        @csrf
        @method('delete')
        
        <div class="card">
            <div class="card-body">
                <div class="modal fade" id="deleteAccount" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{__('auth._delete_account')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ __('auth.delete_msg') }}
                                <div class="col-8">
                                    <label for="yourPassword" class="form-label">{{__('auth.user_password')}}</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <div class="invalid-feedback">{{__('auth.please_password')}}</div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                                <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Disabled Backdrop Modal-->
            </div>
        </div>
        
    </form>

    {{--
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    --}}
</section>
