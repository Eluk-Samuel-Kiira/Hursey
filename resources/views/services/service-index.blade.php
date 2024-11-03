<x-app-layout>
    @section('title', __('Service Index'))
    @section('page', __('Service Index'))
    @section('content') 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title">{{__('Hursey Services')}}</h5>
                            <!-- New User Button -->
                            <button type="button" class="btn btn-outline-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#createNewService">
                                {{ __('Create Service') }}
                            </button>
                        </div>
                        <div class="col-3 ms-auto">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                        {{-- display status message --}}
                        <div id="status"></div>
                        <hr>
                        @include('services.service-component')
                        @include('services.create-service')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>