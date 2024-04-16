<!doctype html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Questioner' }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <h3 class="mx-auto text-center">  
                    <a class="nav-link text-center" href="{{ route('client.test') }}">
                        {{ __('Teszt Kitöltése') }}
                    </a></h3>
                <h5 class="mx-auto text-center d-flex">  
                    @auth
                        <a class="nav-link text-center" href="{{ route('admin.dashboard.index') }}">
                            {{ auth()->user()->name }}
                        </a>
                        <a class="nav-link text-center" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                            Logout
                        </a>
                    @endauth
                    <form class="d-none" action="{{ route('logout') }}" id="logout-form" method="post">
                        @csrf 
                        
                    </form>
                </h5>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>