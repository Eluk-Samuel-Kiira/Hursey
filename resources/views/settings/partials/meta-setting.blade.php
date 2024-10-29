
<form id="updateMetaInfoForm">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <label for="meta_keyword" class="col-md-4 col-lg-3 col-form-label">{{__('roles.meta_keyword')}}</label>
        <div class="col-md-8 col-lg-9">
            <input name="meta_keyword" type="text" class="form-control" id="meta_keyword" value="{{ $app_info->meta_keyword }}">
            <div id="meta_keyword"></div>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="meta_descrip" class="col-md-4 col-lg-3 col-form-label">{{__('roles.meta_descrip')}}</label>
        <div class="col-md-8 col-lg-9">
            <textarea name="meta_descrip" class="form-control" id="meta_descrip" rows="4">{{ $app_info->meta_descrip }}</textarea>
            <div id="meta_descrip"></div>
        </div>
    </div>    

    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
    </div>
</form>