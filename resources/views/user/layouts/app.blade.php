<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @if (!in_array(Route::currentRouteName(), ['user.show.login', 'user.show.register']))
            <div class="d-flex justify-content-between align-items-center px-4 py-3" style="background-color: #f4633a;">
                <div>
                    <a href="{{ route('user.show.curriculum') }}" class="text-white fw-bold me-3" style="background-color: #1ac0d4; border-radius: 10px; padding: 10px 20px; text-decoration: none;">時間割</a>
                    <a href="{{ route('user.show.progress') }}" class="text-white fw-bold me-3" style="background-color: #1ac0d4; border-radius: 10px; padding: 10px 20px; text-decoration: none;">授業進捗</a>
                    <a href="{{ route('user.show.profile') }}" class="text-white fw-bold" style="background-color: #1ac0d4; border-radius: 10px; padding: 10px 20px; text-decoration: none;">プロフィール設定</a>
                </div>
                <div>
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button class="btn btn-link fw-bold" style="color: black; font-size: 1.1rem; text-decoration: none;" onclick="return confirm('ログアウトしますか？')">ログアウト</button>
                    </form>
                </div>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
            @yield('scripts')
        </main>
    </div>
</body>
</html>
