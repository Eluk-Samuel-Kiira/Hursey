<x-app-layout>
    @section('title', __('Reservations Index'))
    @section('page', __('Reservations Index'))
    @section('content') 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('Update The About Us Page')}}</h5>
                    {{-- display status message --}}
                    <div id="status"></div>
                    <hr>
                    @include('bookings.about.about-component')
                </div>
            </div>

            </div>
        </div>
    </section>

    <script>
        function passUniqueIdForUpdate(uniqueId) {
            window.routes = {
                'aboutus.update': "{{ route('aboutus.update', ':uniqueId') }}".replace(':uniqueId', uniqueId),
                // dashboard: "{{ route('dashboard') }}"
            };
        }

        const handleFormSubmit = (formId, routeName, method, componentToReload) => {
            document.getElementById(formId).addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = Object.fromEntries(new FormData(this));
                formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // You can as well perform validations here

                passUniqueIdForUpdate({{$about_us->id}});
                // Pass role name to update route
                
                LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
            });
        };

        // Example usage for multiple forms, pass form id with route name
        handleFormSubmit('updateAboutUsInfoForm', 'aboutus.update', 'PUT', 'updateAboutUsInfoForm');
    </script>
    @endsection
</x-app-layout>