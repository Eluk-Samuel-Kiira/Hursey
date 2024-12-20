<div class="table-responsive" id="serviceIndexTable">
    <table class="table table-bordered table-striped" id="roomTable">
        <thead>
            <tr>
                <th>{{__('Service Name')}}</th>
                <th>{{__('Service Icon/Category')}}</th>
                <th>{{__('Create At')}}</th>
                <th>{{__('roles._status')}}</th>
                <th>{{__('roles._action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($services))
                @foreach($services as $service)
                    <tr>
                        <td>{{ ucwords(str_replace('_', ' ', $service->name)) }}</td>
                        <td>{{ $service->service_icon }}</td>
                        <td>{{ $service->created_at }}</td>
                        @if ($service->status == 'active')
                            <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $service->status)) }}</span></td>
                        @else
                            <td><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ ucwords(str_replace('_', ' ', $service->status)) }}</span></td>
                        @endif
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#editService{{ $service->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @include('services.edit-service')

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteService{{ $service->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="modal" id="deleteService{{ $service->id }}" tabindex="-1">
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
                                                        data-item-url="{{ route('service.destroy', $service->id) }}" 
                                                        data-item-id="{{ $service->id }}"
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
        const modalElement = document.getElementById(`deleteService${itemId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>

