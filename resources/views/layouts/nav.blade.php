<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{asset('css/nav.css')}}">

    <title>Stock Management</title>
</head>
<body>
    <div class="content-body">

        <div class="nav-bar">
            <h1 class="m-3" style="text-align: center; color:white">Poqox Sdn Bhd</h1>

            <a href="/home">Main Dashboard</a>
            @if ($role == 'Operator' || $role == 'Master')
                <a href="/add-stock">Add Stock</a>
            @endif

            @if ($role == 'Master')
                <a href="/users">User List</a>
            @endif

            <div class="logout">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>

</body>
</html>
