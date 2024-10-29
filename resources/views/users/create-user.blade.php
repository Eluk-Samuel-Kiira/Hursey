
<div class="modal fade" id="createNewUser" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles._new_user_create')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createUserForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="yourName" class="form-label">{{__('auth.full_name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="invalid-feedback">{{__('auth.please_name')}}</div>
                            <div id="name"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="yourUsername" class="form-label">{{__('auth.user_email')}}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" name="email" class="form-control" required>
                                <div class="invalid-feedback">{{__('auth.please_username')}}</div>
                            </div>
                            <div id="email"></div>
                        </div>
                    </div><hr>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="yourPhone" class="form-label">{{__('roles._phone_number')}}</label>
                            <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                            <div class="invalid-feedback">{{__('roles.please_phone')}}</div>
                            <div id="phone_number"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">{{__('roles._role_name')}}</label>
                            <select class="form-select" id="role" name="role"  required>
                                <option selected disabled value="">{{__('roles._choose')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucwords(str_replace('_', ' ', $role->name)) }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{__('roles._role_select')}}</div>
                            <div id="role"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label">{{__('roles._status')}}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option disabled value="">{{__('roles._choose')}}</option>
                                <option value="active" selected>{{__('roles._active')}}</option>
                                <option value="inactive">{{__('roles._inactive')}}</option>
                            </select>
                            <div class="invalid-feedback">{{__('roles._status_select')}}</div>
                            <div id="status"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('roles._new_user')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->
