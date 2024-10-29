<x-guest-layout>
    @section('title', __('auth.password_reset_page'))
    @section('content')
        <div class="card mb-3">
            <div class="card-body">

            <div class="pt-4 pb-2">
                <div id="status"></div>
                <h5 class="card-title text-center pb-0 fs-4">{{__('auth.password_reset')}}</h5>
                <p class="text-center small">{{__('auth.forgot_msg')}}</p>
            </div>

            <form id="forgotPasswordForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                    <label for="yourUsername" class="form-label">{{__('auth.user_email')}}</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" required>
                        <div class="invalid-feedback">{{__('auth.please_username')}}</div>
                    </div>
                    <div id="email"></div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">{{__('auth.forgot_password_button')}}</button>
                </div>
            </form>

            </div>
        </div>
        @include('layouts.liveblade-imports')
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                'password.email': "{{ route('password.email') }}",
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
            handleFormSubmit('forgotPasswordForm', 'password.email', 'POST');
            // handleFormSubmit('registerForm', 'register', 'POST');
        </script>
    @endsection


    {{--
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    --}}
</x-guest-layout>
