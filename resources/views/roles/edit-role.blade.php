
<div class="modal fade" id="editRole" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles.edit_role')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editRoleForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('roles._role_name')}}</label>
                        <div class="col-sm-10 has-validation">
                            <select name="role_id" id="role_id" class="form-select" aria-label="Default select example">
                                <option selected>{{ __('roles._role_select') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" data-name="{{ $role->name }}">
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ __('roles.please_role') }}</div>
                        </div>
                        
                        <div id="role_id"></div>
                    </div><hr>

                    <div class="col-12">
                        <label for="role" class="form-label">{{__('roles.give_permission')}}</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkAllPermissionsEdit">
                            <label class="form-check-label" for="checkAllPermissionsEdit">
                                {{ __('roles.select_all') }}
                            </label>
                        </div>

                        <div class="row">
                            @if ($permissions)
                                @foreach ($permissions as $index => $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox-edit" type="checkbox" name="permissionsEdit[]" 
                                                value="{{ $permission->id }}" id="permissionsEdit{{ $permission->id }}">
                                            <label class="form-check-label" for="permissionsEdit{{ $permission->id }}">
                                                {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    @if (($index + 1) % 3 == 0) <!-- Every 3rd permission, close and start a new row -->
                                        </div><div class="row">
                                    @endif
                                @endforeach
                            @endif
                            <div id="permissionsEdit"></div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('roles.edit_role')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->


<script>
    document.getElementById('checkAllPermissionsEdit').addEventListener('change', function() {
        var permissionCheckboxes = document.querySelectorAll('.permission-checkbox-edit');
        permissionCheckboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('checkAllPermissionsEdit').checked;
        });
    });
</script>