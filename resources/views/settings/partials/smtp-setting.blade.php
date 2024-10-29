<form id="updateSMTPForm">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-md-6">
            <div class="row mb-3">
                <label for="mail_mailer" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_mailer')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_mailer" type="text" class="form-control" id="mail_mailer" value="{{ $app_info->mail_mailer }}">
                    <div id="mail_mailer"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_host" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_host')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_host" type="text" class="form-control" id="mail_host" value="{{ $app_info->mail_host }}">
                    <div id="mail_host"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_port" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_port')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_port" type="text" class="form-control" id="mail_port" value="{{ $app_info->mail_port }}">
                    <div id="mail_port"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_username" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_username')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_username" type="text" class="form-control" id="mail_username" value="{{ $app_info->mail_username }}">
                    <div id="mail_username"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_name" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_name')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_name" type="text" class="form-control" id="mail_name" value="{{ $app_info->mail_name }}">
                    <div id="mail_name"></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row mb-3">
                <label for="mail_password" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_password')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_password" type="text" class="form-control" id="mail_password" value="{{ $app_info->mail_password }}">
                    <div id="mail_password"></div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="mail_encryption" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_encryption')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_encryption" type="text" class="form-control" id="mail_encryption" value="{{ $app_info->mail_encryption }}">
                    <div id="mail_encryption"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_address" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_address')}}</label>
                <div class="col-md-8 col-lg-9">
                    <input name="mail_address" type="text" class="form-control" id="mail_address" value="{{ $app_info->mail_address }}">
                    <div id="mail_address"></div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="mail_status" class="col-md-4 col-lg-3 col-form-label">{{__('roles.mail_status')}}</label>
                <div class="col-md-8 col-lg-9">
                    <select name="mail_status" class="form-control" id="mail_status">
                        <option value="enabled" {{ $app_info->mail_status == 'enabled' ? 'selected' : '' }}>Enabled</option>
                        <option value="disabled" {{ $app_info->mail_status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                    </select>
                    <div id="mail_status"></div>
                </div>
            </div>
            
        </div>

    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
    </div>
</form>
