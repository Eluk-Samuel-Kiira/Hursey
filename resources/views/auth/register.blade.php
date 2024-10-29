<x-guest-layout>
    @section('title', __('auth.register_page'))
    @section('content')
        <div class="card mb-3">
            <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">{{__('auth.create_acct')}}</h5>
                <p class="text-center small">{{__('auth.enter_details')}}</p>
            </div>

            <form id="registerForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                    <label for="yourName" class="form-label">{{__('auth.full_name')}}</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                    <div class="invalid-feedback">{{__('auth.please_name')}}</div>
                </div>
                <div id="name"></div>

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
                    <label for="yourPassword" class="form-label">{{__('auth.confirm_password')}}</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    <div class="invalid-feedback">{{__('auth.please_confirm_password')}}</div>
                </div>
                <div id="password_confirmation"></div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">{{__('auth.login_register')}}</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">
                        <a href="{{ route('login') }}">
                            {{__('auth.already_register')}}
                        </a>
                    </p>
                </div>
            </form>

            </div>
        </div>
        @include('layouts.liveblade-imports')
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                register: "{{ route('register') }}",
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
            handleFormSubmit('registerForm', 'register', 'POST');
            // handleFormSubmit('registerForm', 'register', 'POST');
        </script>
    @endsection

    {{--
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    --}}
</x-guest-layout>
