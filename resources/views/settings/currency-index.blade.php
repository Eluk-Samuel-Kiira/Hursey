<x-app-layout>
    @section('title', __('roles.currency_index'))
    @section('page', __('roles.currency'))
    @section('content')
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('roles.currency_table')}}</h5>
                    
                    <div class="d-flex align-items-center">
                        <!-- New User Button -->
                        <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#createNewCurrency">
                            {{ __('roles.create_currency') }}
                        </button>
                        @include('settings.currency.create-currency')
                    
                        <!-- Custom Search Input with Bootstrap's grid column -->
                        <div class="col-3 ms-auto">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                    {{-- display status message --}}
                    <div id="status"></div><hr>

                    <!-- Table with stripped rows -->
                    @include('settings.currency.currency-component')
                </div>
            </div>

            </div>
        </div>
    </section>

    <script>
        window.routes = {
            'currency.store': "{{ route('currency.store') }}",
        };

        const handleFormSubmit = (formId, routeName, method, componentToReload) => {
            document.getElementById(formId).addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Collect form data
                const formData = Object.fromEntries(new FormData(this));
                formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // console.log(formData);
                // Use LiveBlade to submit the form
                LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
                // this.reset(); 
            });
        };

        // Example usage for multiple forms, pass form id with route name
        // 4th parameter is the component to reload
        handleFormSubmit('createCurrencyForm', 'currency.store', 'POST', 'currencyIndexTable');

    </script>

    @endsection
</x-app-layout>