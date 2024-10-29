
<div class="modal fade" id="editNewUser{{ $userId }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles._edit_user')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editUserForm{{ $user->id }}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name{{ $user->id }}" class="form-label">{{__('auth.full_name')}}</label>
                            <input type="text" name="edit_name" class="form-control" id="name{{ $user->id }}" value="{{ $user->name }}" required>
                            <div class="invalid-feedback">{{__('auth.please_name')}}</div>
                            <div id="edit_name{{ $user->id }}"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="yourUsername" class="form-label">{{__('auth.user_email')}}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" name="edit_email" class="form-control" id="email{{ $user->id }}" value="{{ $user->email }}" required>
                                <div class="invalid-feedback">{{__('auth.please_username')}}</div>
                            </div>
                            <div id="edit_email{{ $user->id }}"></div>
                        </div>
                    </div><hr>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="yourPhone" class="form-label">{{__('roles._phone_number')}}</label>
                            <input type="text" name="edit_phone_number" class="form-control" id="phone_number{{ $user->id }}" value="{{ $user->phone_number }}" required>
                            <div class="invalid-feedback">{{__('roles.please_phone')}}</div>
                            <div id="edit_phone_number{{ $user->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">{{__('roles._role_name')}}</label>
                            <select class="form-select" id="role{{ $user->id }}" name="edit_role" required>
                                <option disabled value="">{{ __('roles._choose') }}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $role->name == $user->role ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{__('roles._role_select')}}</div>
                            <div id="edit_role{{ $user->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label">{{__('roles._status')}}</label>
                            <select class="form-select" id="status{{ $user->id }}" name="edit_status" required>
                                <option disabled value="">{{__('roles._choose')}}</option>
                                <option value="active" selected>{{__('roles._active')}}</option>
                                <option value="inactive">{{__('roles._inactive')}}</option>
                            </select>
                            <div class="invalid-feedback">{{__('roles._status_select')}}</div>
                            <div id="edit_status{{ $user->id }}"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalButton{{$userId}}" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="editInstanceLoop({{$user->id}})" class="btn btn-primary">{{__('roles._edit_user')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<script>
    function editInstanceLoop(userId) {
        // console.log(userId);

        var form = document.getElementById('editUserForm' + userId);
        
        var formData = new FormData(form);
        
        var data = Object.fromEntries(formData.entries());
        var updateUrl = '{{ route('user.update', ['user' => ':id']) }}'.replace(':id', userId);
        // console.log(data)


        LiveBlade.editLoop(data, updateUrl, '').then(noErrorStatus => {
            // console.log(noErrorStatus);
            //close modals in loops (optional)
            if (noErrorStatus) {
                var closeButton = document.getElementById('closeModalButton' + userId);
                if (closeButton) {
                    closeButton.click(); // Simulate a click on the close button
                }
            }
        }).catch(error => {
            console.error('An unexpected error occurred:', error);
        });


    }
</script>

