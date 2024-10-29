<x-app-layout>
    @section('title', __('auth.my_profile'))
    @section('page', __('auth.my_profile'))
    @section('content') 
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ getProfileImage() }}" alt="Profile" class="rounded-circle">
                        <h2>{{ auth()->user()->name }}</h2>
                        <h3>{{ auth()->user()->email }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    {{-- status message --}}
                    <div id="status"></div>
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">{{__('auth._overview')}}</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">{{__('auth._edit_profile')}}</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">{{__('auth._settings')}}</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">{{__('auth.change_button')}}</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                            <h5 class="card-title">{{__('auth.profile_details')}}</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">{{__('auth.full_name')}}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                <div class="col-lg-9 col-md-8">Web Designer</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8">USA</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">{{__('auth.user_email')}}</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">
                            @include('profile.partials.delete-user-form')
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            @include('profile.partials.update-password-form')
                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
            </div>
        </div>
        <script>
            // Laravel routes and form handling to be pass to js
            window.routes = {
                'password.update': "{{ route('password.update') }}",
                'profile.update': "{{ route('profile.update') }}",
                'profile.destroy': "{{ route('profile.destroy') }}",
                'verification.send': "{{ route('verification.send') }}",
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
            handleFormSubmit('updatePasswordForm', 'password.update', 'PUT');
            handleFormSubmit('updateProfileInfoForm', 'profile.update', 'PATCH');
            handleFormSubmit('deleteAccountForm', 'profile.destroy', 'DELETE');
            handleFormSubmit('sendVerification', 'verification.send', 'POST');
        </script>
    </section>
    @endsection


    {{--
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> 
    --}}
</x-app-layout>
