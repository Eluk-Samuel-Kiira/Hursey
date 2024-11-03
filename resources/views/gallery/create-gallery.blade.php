
<div class="modal fade" id="createNewGallery" tabindex="-1">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Add Image to Gallery')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="uploadNewImage" class="row g-3 needs-validation" novalidate>
                @csrf
                
                <div class="modal-body text-center">
                    <!-- Image Preview -->
                    <div class="mb-3">
                        <img id="profile-img-preview" src="admin/assets/img/card.jpg" alt="gallery" class="img-thumbnail" style="max-width: 150px;">
                    </div>

                    <!-- Upload and Remove Buttons -->
                    <div class="mb-3">
                        <input type="file" id="profileImage" name="image" accept="image/*" onchange="previewAndUploadProfileImage(event)" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="document.getElementById('profileImage').click();">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" title="Remove profile image" onclick="removeProfileImage();">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>

                    <!-- Form Fields -->
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">{{ __('Image Label') }}</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="invalid-feedback">{{ __('auth.please_name') }}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalButton" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="submitForm()" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<script>
    function previewAndUploadProfileImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('profile-img-preview');
            preview.src = reader.result;
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeProfileImage() {
        document.getElementById('profile-img-preview').src = 'admin/assets/img/card.jpg'; // reset to default
        document.getElementById('profileImage').value = ''; // clear file input
    }
</script>


<script>
        
    function submitForm() {
        // Get form data
        const name = document.getElementById('name').value;
        const imageFile = document.getElementById('profileImage').files[0];
        
        if (!name || !imageFile) {
            alert("Please enter your name and upload an image.");
            return;
        }

        // Prepare form data for AJAX request
        const formData = new FormData();
        formData.append('name', name);
        formData.append('image', imageFile);

        // Send AJAX request
        fetch('/upload-image', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',  
                    icon: 'success',        
                    title: data.message,    
                    showConfirmButton: false,
                    timer: 2000,          
                    timerProgressBar: true,
                    customClass: {
                        popup: 'swal2-show',
                    }
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',  
                    icon: 'error',        
                    title: data.message,    
                    showConfirmButton: false,
                    timer: 5000,          
                    timerProgressBar: true, // Show a progress bar
                    customClass: {
                        popup: 'swal2-show', 
                    }
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while submitting the form.");
        });
    }

</script>