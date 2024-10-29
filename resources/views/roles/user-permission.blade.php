<x-app-layout>
    @section('title', __('roles.user_permission'))
    @section('page', __('roles.user_permission'))
    @section('content') 

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('roles.coming_soon') }}</h4>
            <nav class="d-flex justify-content-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <h5>
                        {{ __('roles.coming_soon_statement') }}
                    </h5>
                </li>
            </ol>
            </nav>
        </div>
    </div>
    
    @endsection
</x-app-layout>