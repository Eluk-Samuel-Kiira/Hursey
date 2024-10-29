
<div class="row" id="rolePermission">
    <div class="col-md-3">
        <div class="nav flex-column nav-pills me-3 flex-wrap d-md-flex" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @if ($roles)
                @foreach ($roles as $role)
                    <button class="nav-link {{ $role->name == 'super_admin' ? 'active' : '' }}" 
                            id="{{ $role->name }}-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#{{ $role->name }}" 
                            type="button" 
                            role="tab" 
                            aria-controls="{{ $role->name }}" 
                            aria-selected="{{ $role->name == 'super_admin' ? 'true' : 'false' }}">
                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                    </button>
                @endforeach                            
            @endif
        </div>
    </div>

    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            @foreach ($roles as $role)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                    id="{{ $role->name }}" 
                    role="tabpanel" 
                    aria-labelledby="{{ $role->name }}-tab">
                    
                    <!-- Display permissions associated with the role in a table -->
                    @php
                        $rolePermissions = $role->permissions->pluck('name')->toArray();
                    @endphp

                    @if (!empty($rolePermissions))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{__('roles.permissions')}}</th>
                                        <th>{{__('roles.permissions')}}</th>
                                        <th>{{__('roles.permissions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (array_chunk($rolePermissions, 3) as $permissionsChunk)
                                        <tr>
                                            @foreach ($permissionsChunk as $permission)
                                                <td>{{ ucwords(str_replace('_', ' ', $permission)) }}</td>
                                            @endforeach

                                            <!-- Fill empty columns if less than 3 permissions in the last chunk -->
                                            @for ($i = count($permissionsChunk); $i < 3; $i++)
                                                <td></td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>{{__('roles.no_permissions')}}</p>
                    @endif
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRole{{ $role->id }}">
                        {{ __('roles.delete_role') }}
                    </button>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="modal" id="deleteRole{{ $role->id }}" tabindex="-1">
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
                                                    data-role-url="{{ route('role.destroy', $role->id) }}" 
                                                    data-role-name="{{ $role->name }}"
                                                    data-role-id="{{ $role->id }}"
                                                    onclick="handleLoopDelete(this)">
                                                {{ __('auth._confirm_button') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                    
                </div>             
            @endforeach
        </div>
    </div>
</div>

<script>
    function handleLoopDelete(button) {
        // Get role information from data attributes
        const roleName = button.getAttribute('data-role-name');
        const roleId = button.getAttribute('data-role-id');
        const deleteUrl = button.getAttribute('data-role-url'); // Directly get the pre-generated URL

        // Call your function to handle the deletion
        LiveBlade.loop(deleteUrl);

        // Optionally, remove the modal if exists
        const modalElement = document.getElementById(`deleteRole${roleId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>