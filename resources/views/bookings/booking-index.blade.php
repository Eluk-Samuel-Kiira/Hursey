<x-app-layout>
    @section('title', __('Reservations Index'))
    @section('page', __('Reservations Index'))
    @section('content') 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('Potential Reservations')}}</h5>
                    
                    <div class="d-flex align-items-center">
                        <!-- Custom Search Input with Bootstrap's grid column -->
                        <div class="col-3 ms-auto">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                    {{-- display status message --}}
                    <div id="status"></div>
                    <hr>

                    <!-- Table with stripped rows -->
                     @include('bookings.booking-component')

                </div>
            </div>

            </div>
        </div>
    </section>
    @endsection
</x-app-layout>