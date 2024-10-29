<x-app-layout>
    @section('title', __('roles.role_mgt'))
    @section('page', __('roles.role_mgt'))
    @section('content') 

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{__('roles.system_role')}}</h5>
                        <button type="button" class="btn btn-outline-secondary w-20" data-bs-toggle="modal" data-bs-target="#createNewRole">
                            {{ __('roles.create_role') }}
                        </button>
                        <button class="btn btn-outline-primary w-20" type="button" data-bs-toggle="modal" data-bs-target="#editRole">
                            {{ __('roles.edit_role') }}
                        </button>
                        <div id="status"></div>
                        <hr>

                        <!-- Role Permissions -->
                        @include('roles.role-permission')
                        <!-- Role Permissions-->

                        @include('roles.create-role')
                        @include('roles.edit-role')

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        
        // Laravel routes and form handling to be pass to js
        function passRoleNameUpdate(roleName) {
            window.routes = {
                'role.store': "{{ route('role.store') }}",
                'role.update': "{{ route('role.update', ':roleName') }}".replace(':roleName', roleName),
                // dashboard: "{{ route('dashboard') }}"
            };
        }

        

        const handleFormSubmit = (formId, routeName, method, componentToReload) => {
            document.getElementById(formId).addEventListener('submit', function(e) {
                e.preventDefault();
                const currentForm = this;
                
                // Collect form data
                const formData = new FormData(this);
                const roleName = formData.get('role_id'); 
                
                // Pass role name to update route
                passRoleNameUpdate(roleName);

                // Manually handle the permissions array
                let permissions = [];
                let permissionsEdit = [];
                document.querySelectorAll('.permission-checkbox:checked').forEach((checkbox) => {
                    permissions.push(checkbox.value);
                });

                document.querySelectorAll('.permission-checkbox-edit:checked').forEach((checkbox) => {
                    permissionsEdit.push(checkbox.value);
                });

                // Convert FormData to object and add permissions separately
                const formObject = Object.fromEntries(formData);
                formObject.permissions = permissions;
                formObject.permissionsEdit = permissionsEdit;
                formObject._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Use LiveBlade to submit the form
                LiveBlade.load(routeName, method, formObject, `#${formId}`, componentToReload);
                currentForm.reset(); 
            });
        };

        // Example usage for multiple forms, pass form id with route name
        // 4th parameter is the component to reload
        handleFormSubmit('createRoleForm', 'role.store', 'POST', 'rolePermission');
        handleFormSubmit('editRoleForm', 'role.update', 'PUT', 'rolePermission');
        // handleFormSubmit('deleteRoleForm', 'role.destroy', 'DELETE', 'rolePermission');

    </script>
    

    @endsection
</x-app-layout>


