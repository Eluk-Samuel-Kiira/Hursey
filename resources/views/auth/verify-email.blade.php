<x-guest-layout>
    @section('title', __('auth.verify_email_page'))
    @section('content')
        <div class="card mb-3">
            <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">{{__('auth.verify_email')}}</h5>
                <p class="text-center small">{{__('auth.thanks_for_signing')}}</p>
            </div>

            <form id="verifyEmailForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div id="status"></div>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">{{__('auth.verify_button')}}</button>
                </div>
                
                <div class="col-12">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-danger w-100">
                            {{ __('auth._logout') }}
                        </button>
                    </form>
                </div>

            </form>

            </div>
        </div>
        @include('layouts.liveblade-imports')
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                'verification.send': "{{ route('verification.send') }}",
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
            handleFormSubmit('verifyEmailForm', 'verification.send', 'POST');
            // handleFormSubmit('registerForm', 'register', 'POST');
        </script>
    @endsection

    {{--
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
    --}}
</x-guest-layout>
