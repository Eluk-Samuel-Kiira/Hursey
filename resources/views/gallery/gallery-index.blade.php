<x-app-layout>
    @section('title', __('Gallery Index'))
    @section('page', __('Gallery Index'))
    @section('content') 
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title">{{__('Gallery/Images')}}</h5>
                            <!-- New User Button -->
                            <button type="button" class="btn btn-outline-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#createNewGallery">
                                {{ __('Upload Gallery') }}
                            </button>
                        </div>
                        {{-- display status message --}}
                        <div id="status"></div>
                        <hr>
                        @include('gallery.gallery-component')
                        @include('gallery.create-gallery')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>