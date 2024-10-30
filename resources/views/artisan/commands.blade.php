<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run Artisan Commands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<section class="section">
    <div class="container">
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
                        @if(session('output'))
                            <div class="alert alert-success">
                                {!! nl2br(e(session('output'))) !!}
                            </div>
                        @endif

                        <form action="{{ route('artisan.run') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="command">Enter Command:</label>
                                <input type="text" name="command" id="command" class="form-control" placeholder="e.g., migrate, db:seed, optimize:clear" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Run Command</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
