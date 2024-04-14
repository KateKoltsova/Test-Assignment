<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test-Assignment</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

</head>
<body>
<div>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif

    <button><a href="{{ route('getToken') }}">Get token and register</a></button>
    <br>
    @if(\Illuminate\Support\Facades\Route::currentRouteName() !== 'users.list')
        <button><a href="{{ route('users.list') }}">Users List</a></button>
    @endif
    <br>
    @if(\Illuminate\Support\Facades\Route::currentRouteName() !== 'positions.list')
        <button><a href="{{ route('positions.list') }}">Positions List</a></button>
    @endif
</div>
<div>
    <h2>@yield('head')</h2>

    @yield('content')

    @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'users.list'
        OR \Illuminate\Support\Facades\Route::currentRouteName() == 'users.view')
        <table>
            <thead>
            <tr>
                <th>Photo</th>
                <th>Position</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Date</th>
            </tr>
            </thead>
            <tbody>

            @yield('tbody')

            </tbody>
        </table>

        @yield('nav-buttons')
    @endif

</div>
</body>
</html>
