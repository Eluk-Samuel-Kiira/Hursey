<section id="updateLogoFaviconForm">
    <div class="row mb-3">
        <!-- Logo Column -->
        <div class="col-md-5">
            <label for="logoImage" class="col-form-label">{{__('roles._logo')}}</label>
            <div class="text-center">
                <img id="logo-img-preview" src="{{ getLogoImage() }}" alt="Logo" style="max-width: 150px; cursor: pointer;" onclick="document.getElementById('logoImage').click();">
                <div class="pt-2">
                    <input type="file" id="logoImage" name="logo_image" accept="image/*" onchange="previewAndUploadImage(event, 'logo-img-preview', '{{ route('logo.upload') }}', '{{ getLogoImage() }}', 'logo_image')" style="display: none;">
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Upload new logo" onclick="document.getElementById('logoImage').click();">
                        <i class="bi bi-upload"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove logo" onclick="removeImage('logo-img-preview', 'logoImage', '{{ getLogoImage() }}');">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Vertical Divider -->
        <div class="col-md-1 d-flex align-items-center justify-content-center">
            <div style="border-left: 1px solid #ccc; height: 100%;"></div>
        </div>

        <!-- Favicon Column -->
        <div class="col-md-6">
            <label for="faviconImage" class="col-form-label">{{__('roles._favicon')}}</label>
            <div class="text-center">
                <img id="favicon-img-preview" src="{{ getFaviconImage() }}" alt="Favicon" style="max-width: 50px; cursor: pointer;" onclick="document.getElementById('faviconImage').click();">
                <div class="pt-2">
                    <input type="file" id="faviconImage" name="favicon_image" accept="image/*" onchange="previewAndUploadImage(event, 'favicon-img-preview', '{{ route('favicon.upload') }}', '{{ getFaviconImage() }}', 'favicon_image')" style="display: none;">
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" title="Upload new favicon" onclick="document.getElementById('faviconImage').click();">
                        <i class="bi bi-upload"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove favicon" onclick="removeImage('favicon-img-preview', 'faviconImage', '{{ getFaviconImage() }}');">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    // Function to preview and upload the selected image with validation
    function previewAndUploadImage(event, previewElementId, uploadRoute, defaultImage, fileInputName) {
        const image = document.getElementById(previewElementId);
        const file = event.target.files[0];

        // Validate file type (accept only images)
        if (fileInputName === 'favicon_image') {
            const allowedTypes = ['image/x-icon']; // MIME type for .ico files
            const allowedError = '{{ __('roles.allowe_type') }}'; 
            
            if (!allowedTypes.includes(file.type)) {
                fileErrorAlerts(allowedError);
                return;
            }
        } else {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const allowedError = '{{__('auth.allowe_type')}}';
            if (!allowedTypes.includes(file.type)) {
                fileErrorAlerts(allowedError);
                return;
            }
        }

        // Validate file size (e.g., limit to 5MB)
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes
        const allowedSize = '{{__('auth.allowed_size')}}';
        if (file.size > maxSize) {
            fileErrorAlerts(allowedSize);
            return;
        }

        // If validation passes, show image preview and upload file
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Automatically upload the file
            LiveBlade.uploadImage(file, uploadRoute, fileInputName);
        }
    }

    function fileErrorAlerts(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: message,
        });
    }
    

    // Function to remove the image preview and reset to default
    function removeImage(previewElementId, fileInputId, defaultImage) {
        const image = document.getElementById(previewElementId);
        const input = document.getElementById(fileInputId);

        image.src = defaultImage; // Reset to default image
        input.value = ""; // Clear the input file value
    }
</script>

