<x-app-layout>
    @section('title', __('roles._users_table'))
    @section('page', __('roles._users_table'))
    @section('content')
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('roles._users_table')}}</h5>
                    
                    <div class="d-flex align-items-center">
                        <!-- New User Button -->
                        <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#createNewUser">
                            {{ __('roles._new_user') }}
                        </button>
                    
                        <!-- Loading Button -->
                        <button class="btn btn-primary me-3" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    
                        <!-- Custom Search Input with Bootstrap's grid column -->
                        <div class="col-3 ms-auto">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                    {{-- display status message --}}
                    <div id="status"></div>
                    <hr>

                    <!-- Table with stripped rows -->
                    @include('users.users-comp')
                    <!-- End Table with stripped rows -->
                    @include('users.create-user')

                </div>
            </div>

            </div>
        </div>
    </section>

    <script>
            window.routes = {
                'user.store': "{{ route('user.store') }}",
                // 'user.update': "{{ route('user.update', ':userId') }}".replace(':userId', userId),
            };
    
            const handleFormSubmit = (formId, routeName, method, componentToReload) => {
                document.getElementById(formId).addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Collect form data
                    const formData = Object.fromEntries(new FormData(this));
                    formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Use LiveBlade to submit the form
                    LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
                    // this.reset(); 
                });
            };
    
            // Example usage for multiple forms, pass form id with route name
            // 4th parameter is the component to reload
            handleFormSubmit('createUserForm', 'user.store', 'POST', 'userIndexTable');
    
    </script>
    

    @endsection
</x-app-layout>