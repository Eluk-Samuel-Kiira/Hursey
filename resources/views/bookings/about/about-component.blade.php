
@if (isset($about_us))
    <form id="updateAboutUsInfoForm">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label for="no_staff" class="col-md-4 col-lg-3 col-form-label">{{__('Number Of Staff')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="no_staff" type="number" class="form-control" id="no_staff" value="{{ $about_us->no_staff }}">
                <div id="no_staff"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="no_room" class="col-md-4 col-lg-3 col-form-label">{{__('Number of Rooms')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="no_room" type="number" class="form-control" id="no_room" value="{{ $about_us->no_room }}">
                <div id="no_room"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="no_clients" class="col-md-4 col-lg-3 col-form-label">{{__('Number of Clients Serviced')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="no_clients" type="number" class="form-control" id="no_clients" value="{{ $about_us->no_clients }}">
                <div id="no_clients"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-lg-3 col-form-label">{{__('About Title')}}</label>
            <div class="col-md-8 col-lg-9">
                <input name="title" type="text" class="form-control" id="title" value="{{ $about_us->title }}">
                <div id="title"></div>
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="about_text" class="col-md-4 col-lg-3 col-form-label">{{__('About Us Description')}}</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="about_text" class="form-control" id="about_text" rows="4">{{ $about_us->about_text }}</textarea>
                <div id="about_text"></div>
            </div>
        </div>    

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{__('auth._save_changes')}}</button>
        </div>
    </form>
@else
    {{__('No About Us Information')}}
@endif