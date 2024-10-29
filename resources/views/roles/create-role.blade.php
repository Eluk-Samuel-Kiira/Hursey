
<div class="modal fade" id="createNewRole" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles.create_new_role')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createRoleForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="col-12">
                        <label for="role" class="form-label">{{__('roles._role_name')}}</label>
                        <div class="input-group has-validation">
                            <input type="text" name="name" class="form-control" required>
                            <div class="invalid-feedback">{{__('roles.please_role')}}</div>
                        </div>
                        <div id="name"></div>
                    </div><hr>

                    <div class="col-12">
                        <label for="role" class="form-label">{{__('roles.give_permission')}}</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkAllPermissions">
                            <label class="form-check-label" for="checkAllPermissions">
                                {{ __('roles.select_all') }}
                            </label>
                        </div>

                        <div class="row">
                            @if ($permissions)
                                @foreach ($permissions as $index => $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" 
                                                value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    @if (($index + 1) % 3 == 0) <!-- Every 3rd permission, close and start a new row -->
                                        </div><div class="row">
                                    @endif
                                @endforeach
                            @endif
                            <div id="permissions"></div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('roles.create_role')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<script>
    document.getElementById('checkAllPermissions').addEventListener('change', function() {
        var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
        permissionCheckboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('checkAllPermissions').checked;
        });
    });
</script>
