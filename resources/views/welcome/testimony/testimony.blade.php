<x-app-layout>
    @section('title', __('Testimony Index'))
    @section('page', __('Testimony Index'))
    @section('content') 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title">{{__('Hursey Testimony')}}</h5>
                        </div>
                        <div class="col-3 ms-auto">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                        {{-- display status message --}}
                        <div id="status"></div>
                        <hr>
                        @include('welcome.testimony.testimony-index')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>