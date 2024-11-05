<div class="modal fade" id="editService{{ $service->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Service')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editServiceForm{{$service->id}}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="yourName" class="form-label">{{__('Service Name')}}</label>
                            <input type="text" name="name" class="form-control" value="{{ $service->name }}" id="name{{ $service->id }}" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="name{{ $service->id }}"></div>
                        </div>

                        <div class="col-md-6">
                            <!-- Preview for selected image -->
                            <div id="selectedImagePreview{{ $service->id }}" class="mt-3">
                                <img src="" alt="Selected Image" class="img-thumbnail" style="display: none; max-width: 150px;">
                            </div>
                            <label for="galleryDropdown{{ $service->id }}" class="form-label">{{ __('Select Room Image') }}</label>
                            <select class="form-select" id="galleryDropdown{{ $service->id }}" name="service_icon" onchange="showImagePreview({{ $service->id }}, this)">
                                <option selected disabled>Select an image</option>
                                @foreach ($galleries as $gallery)
                                    <option value="{{ $gallery->id }}" data-thumbnail="{{ asset('storage/' . $gallery->image) }}">
                                        {{ $gallery->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="service_icon{{ $service->id }}"></div>
                        </div>
                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="yourName" class="form-label">{{__('Service Description')}}</label>
                            <textarea class="form-control" name="narration" id="narration{{ $service->id }}">{{ $service->narration }}</textarea>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="narration{{ $service->id }}"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalButton{{ $service->id }}"  class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="editInstanceLoop({{$service->id}})" class="btn btn-primary">{{__('Edit Service')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->



<script>
    
    function editInstanceLoop(uniqueId) {
        // console.log(uniqueId);

        var form = document.getElementById('editServiceForm' + uniqueId);

        var formData = new FormData(form);
        var data = Object.fromEntries(formData.entries());

        var updateUrl = '{{ route('service.update', ['service' => ':id']) }}'.replace(':id', uniqueId);
        // console.log(data)


        LiveBlade.editLoop(data, updateUrl, '').then(noErrorStatus => {
            // console.log(noErrorStatus);
            //close modals in loops (optional)
            if (noErrorStatus) {
                var closeButton = document.getElementById('closeModalButton' + uniqueId);
                if (closeButton) {
                    closeButton.click(); // Simulate a click on the close button
                }

            }
        }).catch(error => {
            console.error('An unexpected error occurred:', error);
        });
    }

</script>


<script>
    function showImagePreview(roomId, selectElement) {
        // Get the selected option
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const thumbnailUrl = selectedOption.getAttribute('data-thumbnail');

        // Get the preview image element
        const previewImage = document.querySelector(`#selectedImagePreview${roomId} img`);

        // Update the preview image source and display it
        if (thumbnailUrl) {
            previewImage.src = thumbnailUrl; // Set the image source
            previewImage.style.display = 'block'; // Make the image visible
        } else {
            previewImage.src = ''; // Clear the image source
            previewImage.style.display = 'none'; // Hide the image if no selection
        }
    }
</script>

