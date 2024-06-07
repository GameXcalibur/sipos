<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Choose Location | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body{
            background: #888 !important;
        }
    </style>
</head>

<body class="c-app flex-row align-items-center">
<div class="container">
    <div class="row mb-3 justify-content-center">
        <div class="col-3 d-flex justify-content-center">
            <img width="300" src="{{ asset('images/logo-dark.png') }}" alt="Logo">
        </div>
        <div class="col-3 d-flex justify-content-center">
            <img width="200" src="{{ asset('images/ms.png') }}" alt="Logo">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="{{ Route::has('register') ? 'col-md-8' : 'col-md-5' }}">

            <div class="card-group">
                <div class="card p-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <h2>Choose Your Location</h2>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CoreUI -->
<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
