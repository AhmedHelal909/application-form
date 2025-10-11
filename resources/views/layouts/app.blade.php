<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Lighthouse App') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles (Breeze uses Tailwind by default) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f9fafb;
            min-height: 100vh;
        }
        nav {
            background: #2563eb;
            color: #fff;
        }
        nav a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 700px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>

    @yield('head')
</head>
<body>

    <nav class="p-4 flex justify-between items-center">
        <div>
            <a href="{{ url('/') }}"><strong>{{ config('app.name', 'Lighthouse App') }}</strong></a>
        </div>

        <div>
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <span>Hello, {{ Auth::user()->name }}</span>
                <a href="{{ route('applications.create') }}">Submit Application</a>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
