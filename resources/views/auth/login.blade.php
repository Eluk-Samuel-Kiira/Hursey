<x-guest-layout>
    @section('title', __('auth.login_page'))
    @section('content')
        <div class="card mb-3">
            <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">{{__('auth.login_to')}}</h5>
                <p class="text-center small">{{__('auth.enter_login')}}</p>
            </div>

            <form id="loginForm" class="row g-3 needs-validation" novalidate>
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
                    <label for="yourPassword" class="form-label">{{__('auth.user_password')}}</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">{{__('auth.please_password')}}</div>
                </div>
                <div id="password"></div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">{{__('auth.remember_me')}}</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">{{__('auth.login_button')}}</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{__('auth.forgot_pass')}}
                            </a>
                        @endif
                    </p>
                </div>
            </form>

            </div>
        </div>
        @include('layouts.liveblade-imports')
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                login: "{{ route('login') }}",
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
            handleFormSubmit('loginForm', 'login', 'POST');
            // handleFormSubmit('registerForm', 'register', 'POST');
        </script>
    @endsection

    {{--
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    --}}
</x-guest-layout>
