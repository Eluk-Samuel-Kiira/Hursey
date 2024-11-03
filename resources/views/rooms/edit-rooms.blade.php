<div class="modal fade" id="editNewRoom{{ $room->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Room')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editRoomForm{{$room->id}}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="yourName" class="form-label">{{__('Room Name')}}</label>
                            <input type="text" name="name" class="form-control" value="{{ $room->name }}" id="name{{ $room->id }}" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="name{{ $room->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="yourName" class="form-label">{{__('Room Price')}}</label>
                            <input type="number" name="price" class="form-control" value="{{ $room->id }}" id="price{{ $room->id }}" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="price{{ $room->id }}"></div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Preview for selected image -->
                            <div id="selectedImagePreview{{ $room->id }}" class="mt-3">
                                <img src="" alt="Selected Image" class="img-thumbnail" style="display: none; max-width: 150px;">
                            </div>
                            <label for="galleryDropdown{{ $room->id }}" class="form-label">{{ __('Select Room Image') }}</label>
                            <select class="form-select" id="galleryDropdown{{ $room->id }}" name="image_id" onchange="showImagePreview({{ $room->id }}, this)">
                                <option selected disabled>Select an image</option>
                                @foreach ($galleries as $gallery)
                                    <option value="{{ $gallery->id }}" data-thumbnail="{{ asset('storage/' . $gallery->image) }}">
                                        {{ $gallery->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="image_id{{ $room->id }}"></div>
                        </div>
                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="yourName" class="form-label">{{__('Bath Rooms')}}</label>
                            <input type="number" name="bath" class="form-control" value="{{ $room->bath }}" id="bath{{ $room->id }}" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="bath{{ $room->id }}"></div>
                        </div>

                        <div class="col-md-2">
                            <label for="yourName" class="form-label">{{__('Bed Rooms')}}</label>
                            <input type="number" name="bed" class="form-control" value="{{ $room->bed }}" id="bed{{ $room->id }}" required>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="bed{{ $room->id }}"></div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="roomStatus" class="form-label">{{ __('Select Room Status') }}</label>
                            <select class="form-select" id="roomStatus" name="status">
                                <option value="free" {{ $room->status === 'free' ? 'selected' : '' }}>Free</option>
                                <option value="reserved" {{ $room->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                <option value="checked_in" {{ $room->status === 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                <option value="checked_out" {{ $room->status === 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="yourName" class="form-label">{{__('Room Description')}}</label>
                            <textarea class="form-control" name="narration" id="narration{{ $room->id }}">{{ $room->narration }}</textarea>
                            <div class="invalid-feedback">{{__('auth.fill_form')}}</div>
                            <div id="narration{{ $room->id }}"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalButton{{ $room->id }}"  class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="editInstanceLoop({{$room->id}})" class="btn btn-primary">{{__('Edit Room')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

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



<script>
    
    function editInstanceLoop(uniqueId) {
        // console.log(uniqueId);

        var form = document.getElementById('editRoomForm' + uniqueId);

        var formData = new FormData(form);
        var data = Object.fromEntries(formData.entries());

        var updateUrl = '{{ route('room.update', ['room' => ':id']) }}'.replace(':id', uniqueId);
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
