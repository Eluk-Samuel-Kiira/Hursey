<!-- resources/views/artisan/commands.blade.php -->

<x-app-layout>
    @section('title', __('Artisan Commands'))
    @section('page', __('Artisan Commands'))

    @section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Run Artisan Commands') }}</h5>
                        
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('artisan.run') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="command">Select Command:</label>
                                <select name="command" id="command" class="form-control">
                                    <option value="optimize:clear">Optimize Clear</option>
                                    <option value="migrate">Run Migrations</option>
                                    <option value="db:seed">Run Seeder</option>
                                    <option value="storage:link">Storage Link</option>
                                    <option value="migrate:rollback">Migrate Rollback</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Run Command</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>
