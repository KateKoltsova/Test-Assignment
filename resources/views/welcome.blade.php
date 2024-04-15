<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test-Assignment</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar nav-tabs navbar-expand-lg bg-body-tertiary d-grid justify-content-center">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-pills navbar-nav me-auto gap-2 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('getToken') }}">Get token and register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.list') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('positions.list') }}">Positions</a>
                </li>
                {{--                @endif--}}
            </ul>
        </div>
    </div>
</nav>

<div class="d-grid gap-2 col-8 mx-auto justify-content-center">
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
</div>

<div class="d-grid gap-2 col-8 mx-auto justify-content-center">
    <h2>@yield('head')</h2>

    @yield('content')
</div>

<div class="d-grid gap-2 col-8 mx-auto justify-content-center">
    @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'users.list'
        OR \Illuminate\Support\Facades\Route::currentRouteName() == 'users.view')
        <table class="table table-bordered table-sm table-hover align-middle">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Position</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Date</th>
                @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'users.list')
                    <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody class="table-group-divider">

            @yield('tbody')

            </tbody>
        </table>

    @endif

</div>

    @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'users.list'
        OR \Illuminate\Support\Facades\Route::currentRouteName() == 'users.view')
        @yield('nav-buttons')
    @endif
</nav>

</body>
</html>
