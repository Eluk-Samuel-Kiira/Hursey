
<div class="modal fade" id="createNewService" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Create New Service')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createServiceForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="yourName" class="form-label">{{__('Service Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="name"></div>
                        </div>
                        <div class="col-md-6">
                            <!-- Preview for selected image -->
                            <div id="selectedImagePreview" class="mt-3">
                                <img src="" alt="Selected Image" class="img-thumbnail" style="display: none; max-width: 150px;">
                            </div>
                            <label for="yourName" class="form-label">{{__('Select Room Image')}}</label>
                            <select class="form-select" id="iconSelect" name="service_icon">
                                <option selected disabled>Select an image</option>
                                @foreach ($galleries as $gallery)
                                    <option value="{{ $gallery->id }}" data-thumbnail="{{ asset('storage/' . $gallery->image) }}">
                                        {{ $gallery->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="service_icon"></div>
                        </div>
                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="yourName" class="form-label">{{__('Service Description')}}</label>
                            <textarea class="form-control" name="narration" id="narration"></textarea>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="narration"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Create Room')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<script>
    // JavaScript to update image preview based on dropdown selection
    document.getElementById('iconSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-thumbnail');
        const imagePreview = document.getElementById('selectedImagePreview').querySelector('img');

        if (imageUrl) {
            imagePreview.src = imageUrl;
            imagePreview.style.display = 'block';
        } else {
            imagePreview.style.display = 'none';
        }
    });
</script>

<script>
    window.routes = {
        'service.store': "{{ route('service.store') }}",
    };

    const handleFormSubmit = (formId, routeName, method, componentToReload) => {
        document.getElementById(formId).addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const formData = Object.fromEntries(new FormData(this));
            formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // console.log(formData);
            // Use LiveBlade to submit the form
            LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
            // this.reset(); 
        });
    };
    
    handleFormSubmit('createServiceForm', 'service.store', 'POST', 'serviceIndexTable');
    

    </script>
