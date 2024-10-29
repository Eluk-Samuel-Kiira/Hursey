<x-guest-layout>
    @section('title', __('auth.confirm_password'))
    @section('content')
        <div class="card mb-3">
            <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">{{__('auth.confirm_password_your')}}</h5>
                <p class="text-center small">{{__('auth.secure_area')}}</p>
            </div>

            <form id="passwordConfirmForm" class="row g-3 needs-validation" novalidate>
                @csrf

                <div class="col-12">
                    <label for="yourPassword" class="form-label">{{__('auth.user_password')}}</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">{{__('auth.please_password')}}</div>
                </div>
                <div id="password"></div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">{{__('auth._confirm_button')}}</button>
                </div>
            </form>

            </div>
        </div>
        @include('layouts.liveblade-imports')
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                'password.confirm': "{{ route('password.confirm') }}",
                dashboard: "{{ route('dashboard') }}"
            };

            const handleFormSubmit = (formId, routeName, method) => {
                document.getElementById(formId).addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = Object.fromEntries(new FormData(this));
                    formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // You can as well perform validations here
                    
                    LiveBlade.load(routeName, method, formData, `#${formId}`);
                });
            };

            // Example usage for multiple forms, pass form id with route name
            handleFormSubmit('passwordConfirmForm', 'password.confirm', 'POST');
            // handleFormSubmit('registerForm', 'register', 'POST');
        </script>
    @endsection

    {{--
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>
    
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
    --}}
</x-guest-layout>
