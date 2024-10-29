<x-app-layout>
    @section('title', __('roles._basic'))
    @section('page', __('roles._basic'))
    @section('content')
    
    
    <section class="section profile">
  
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">{{__('roles._basic')}}</h5>
                <div id="status"></div><hr>

                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#logo-favicon">{{__('roles.logo_favicon')}}</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#app-info">{{__('roles._app_info')}}</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#smtp-settings">{{__('roles._smtp_setting')}}</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#meta-setting">{{__('roles.meta_setting')}}</button>
                    </li>

                </ul>

                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="logo-favicon">
                        @include('settings.partials.logo-favicon')
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="app-info">
                        @include('settings.partials.app-information')
                    </div>

                    <div class="tab-pane fade pt-3" id="smtp-settings">
                        @include('settings.partials.smtp-setting')
                    </div>

                    <div class="tab-pane fade pt-3" id="meta-setting">
                        @include('settings.partials.meta-setting')
                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </section>

    
    <script>
        // Laravel routes and form handling to be pass to js
        function passUniqueIdForUpdate(uniqueId) {
            window.routes = {
                'setting.update': "{{ route('setting.update', ':uniqueId') }}".replace(':uniqueId', uniqueId),
                // dashboard: "{{ route('dashboard') }}"
            };
        }

        const handleFormSubmit = (formId, routeName, method, componentToReload) => {
            document.getElementById(formId).addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = Object.fromEntries(new FormData(this));
                formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // You can as well perform validations here

                passUniqueIdForUpdate({{$app_info->id}});
                // Pass role name to update route
                
                LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
            });
        };

        // Example usage for multiple forms, pass form id with route name
        handleFormSubmit('updateAppInfoForm', 'setting.update', 'PUT', 'updateAppInfoForm');
        handleFormSubmit('updateSMTPForm', 'setting.update', 'PUT', 'updateSMTPForm');
        handleFormSubmit('updateMetaInfoForm', 'setting.update', 'PUT', 'updateMetaInfoForm');
    </script>
    
    @endsection
</x-app-layout>