<section>

    <!-- Profile Edit Form -->
    <form id="updateProfileInfoForm">
        @csrf
        @method('patch')

        <!-- Profile Image Preview -->
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img id="profile-img-preview" src="{{ getProfileImage() }}" alt="Profile" style="max-width: 150px;">
                <div class="pt-2">
                    <input type="file" id="profileImage" name="profile_image" accept="image/*" onchange="previewAndUploadProfileImage(event)" style="display: none;">
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="document.getElementById('profileImage').click();">
                        <i class="bi bi-upload"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="removeProfileImage();">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{__('auth.full_name')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                <div id="name"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">{{__('auth.user_email')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                <div id="email"></div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
        </div>
    </form><!-- End Profile Edit Form -->

    
    <!-- JavaScript to handle real-time image preview and upload -->
    <script>
        
        // Function to preview and upload the selected profile image with validation
        function previewAndUploadProfileImage(event) {
            const image = document.getElementById('profile-img-preview');
            const file = event.target.files[0];
            
            // Validate file type (accept only images)
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const allowedError = '{{__('auth.allowe_type')}}'
            if (!allowedTypes.includes(file.type)) {
                alert(allowedError);
                return;
            }

            // Validate file size (e.g., limit to 2MB)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            const allowedSize = '{{__('auth.allowed_size')}}'
            if (file.size > maxSize) {
                alert(allowed_size);
                return;
            }

            // If validation passes, show image preview and upload file
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                }
                reader.readAsDataURL(file);

                // Automatically upload the file
                uploadProfileImage(file);
            }
        }

        // Function to upload the image via AJAX
        function uploadProfileImage(file) {
            const formData = new FormData();
            formData.append('profile_image', file); // Append the file to the FormData object

            fetch('{{ route("profile.upload_image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to upload image');
                }
                return response.json();
            })
            .then(data => {
                const message = '{{__('auth.image_uploaded')}}'
                console.log(message, data);
                // Optionally handle success or update image path here
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: message,
                });
            })
            .catch(error => {
                const message = '{{__('auth.image_uploaded_error')}}'
                console.error(message, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: message,
                });
            });
        }

        // Function to remove the profile image preview
        function removeProfileImage() {
            const image = document.getElementById('profile-img-preview');
            const input = document.getElementById('profileImage');
            
            image.src = "{{ asset('admin/assets/img/profile-img.jpg') }}"; // Reset to default image
            input.value = ""; // Clear the input file value
        }
    </script>

    {{--
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    --}}
</section>
