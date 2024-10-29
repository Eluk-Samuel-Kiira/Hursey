<div class="table-responsive" id="userIndexTable">
    <table class="table table-bordered table-striped" id="userTable">
        <thead>
            <tr>
                <th>{{__('roles._full_name')}}</th>
                <th>{{__('roles._email')}}</th>
                <th>{{__('roles._role')}}</th>
                <th>{{__('roles._phone_number')}}</th>
                <th>{{__('roles._created_at')}}</th>
                <th>{{__('roles._status')}}</th>
                <th>{{__('roles._action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
                @foreach($users as $user)
                    <tr>
                        <td>{{ ucwords(str_replace('_', ' ', $user->name)) }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->created_at }}</td>
                        @if ($user->status == 'active')
                            <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $user->status)) }}</span></td>
                        @else
                            <td><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ ucwords(str_replace('_', ' ', $user->status)) }}</span></td>
                        @endif
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#editNewUser{{ $user->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @include('users.edit-user', ['userId' => $user->id])

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="modal" id="deleteUser{{ $user->id }}" tabindex="-1">
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
                                                                data-user-url="{{ route('user.destroy', $user->id) }}" 
                                                                data-user-id="{{ $user->id }}"
                                                                onclick="deleteUser(this)">
                                                            {{ __('auth._confirm_button') }}
                                                        </button>
                                                    </div>
                                                </div>
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
        setupTableSearch('searchInput', 'userTable');
        
    });
</script>


<script>
    function deleteUser(button) {
        // Get role information from data attributes
        const userId = button.getAttribute('data-user-id');
        const deleteUrl = button.getAttribute('data-user-url'); // Directly get the pre-generated URL

        // Call your function to handle the deletion
        LiveBlade.loop(deleteUrl);

        // Optionally, remove the modal if exists
        const modalElement = document.getElementById(`deleteUser${userId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>
