<div class="table-responsive" id="messageIndexTable">
    <table class="table table-bordered table-striped" id="messageTable">
        <thead>
            <tr>
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Subject')}}</th>
                <th>{{__('Message')}}</th>
                <th>{{__('Create At')}}</th>
                <th>{{__('roles._action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($messages))
                @foreach($messages as $message)
                    <tr>
                        <td>{{ ucwords(str_replace('_', ' ', $message->name)) }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMessage{{ $message->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="modal" id="deleteMessage{{ $message->id }}" tabindex="-1">
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

                                                <!-- Delete Form -->
                                                <form action="{{ route('message.destroy', $message->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">{{ __('auth._confirm_button') }}</button>
                                                </form>
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
        setupTableSearch('searchInput', 'messageTable');
        
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
        const modalElement = document.getElementById(`deleteMessage${itemId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>