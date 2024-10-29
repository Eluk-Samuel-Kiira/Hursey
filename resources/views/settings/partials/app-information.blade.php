
<form id="updateAppInfoForm">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <label for="app_name" class="col-md-4 col-lg-3 col-form-label">{{__('roles.app_name')}}</label>
        <div class="col-md-8 col-lg-9">
            <input name="app_name" type="text" class="form-control" id="app_name" value="{{ $app_info->app_name }}">
            <div id="app_name"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="app_contact" class="col-md-4 col-lg-3 col-form-label">{{__('roles.app_contact')}}</label>
        <div class="col-md-8 col-lg-9">
            <input name="app_contact" type="text" class="form-control" id="app_contact" value="{{ $app_info->app_contact }}">
            <div id="app_contact"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="app_email" class="col-md-4 col-lg-3 col-form-label">{{__('roles.app_email')}}</label>
        <div class="col-md-8 col-lg-9">
            <input name="app_email" type="email" class="form-control" id="app_email" value="{{ $app_info->app_email }}">
            <div id="app_email"></div>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
    </div>
</form>