<div class="table-responsive" id="roomIndexTable">
    <table class="table table-bordered table-striped" id="roomTable">
        <thead>
            <tr>
                <th>{{__('image')}}</th>
                <th>{{__('Room Name')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Bath')}}</th>
                <th>{{__('Bed')}}</th>
                <th>{{__('Create At')}}</th>
                <th>{{__('roles._status')}}</th>
                <th>{{__('roles._action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($rooms))
                @foreach($rooms as $room)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $room->imageName->image) }}" alt="img" class="img-fluid w-55" style="max-width: 80px; max-height: 80px;">
                        </td>
                        <td>{{ ucwords(str_replace('_', ' ', $room->name)) }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->bath }}</td>
                        <td>{{ $room->bed }}</td>
                        <td>{{ $room->created_at }}</td>
                        <td>
                            @if ($room->status === 'free')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $room->status)) }}
                                </span>
                            @elseif ($room->status === 'reserved')
                                <span class="badge bg-warning">
                                    <i class="bi bi-clock me-1"></i> {{ ucwords(str_replace('_', ' ', $room->status)) }}
                                </span>
                            @elseif ($room->status === 'checked_in')
                                <span class="badge bg-info">
                                    <i class="bi bi-person-fill me-1"></i> {{ ucwords(str_replace('_', ' ', $room->status)) }}
                                </span>
                            @elseif ($room->status === 'checked_out')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $room->status)) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#editNewRoom{{ $room->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @include('rooms.edit-rooms')

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteRoom{{ $room->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="modal" id="deleteRoom{{ $room->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('roles.confirm_delete') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('roles.delete_message') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('auth._close') }}</button>
                                                <button type="button" class="btn btn-primary confirm-delete" 
                                                        data-item-url="{{ route('room.destroy', $room->id) }}" 
                                                        data-item-id="{{ $room->id }}"
                                                        onclick="deleteItem(this)">
                                                    {{ __('auth._confirm_button') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>{{__('roles.no_users')}}</p>
            @endif
        </tbody>
    </table>
</div>



<script>
    // Reusable function to filter table based on search input
    function setupTableSearch(inputId, tableId) {
        LiveBlade.searchTableItems(inputId, tableId)
    }

    // Set up the event listeners after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        setupTableSearch('searchInput', 'roomTable');
        
    });
</script>

<script>
    function deleteItem(button) {
        // Get role information from data attributes
        const itemId = button.getAttribute('data-item-id');
        const deleteUrl = button.getAttribute('data-item-url'); 

        console.log(deleteUrl)
        // Call your function to handle the deletion
        LiveBlade.loop(deleteUrl);

        // Optionally, remove the modal if exists
        const modalElement = document.getElementById(`deleteRoom${itemId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>

