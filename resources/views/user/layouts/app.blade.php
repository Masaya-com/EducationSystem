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

    <!-- Bootstrap3 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ▼ ナビバーのデザイン調整 */
        .navbar-custom {
            background-color: navy;
            border-radius: 0;
            border: none;
            padding: 10px 20px;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom a {
            color: white !important;
            font-weight: bold;
        }
        .navbar-custom .navbar-brand:hover,
        .navbar-custom a:hover {
            text-decoration: underline;
        }

        /* ボタン風リンク */
        .navbar-custom .nav > li > a {
            padding: 8px 15px;
            margin-right: 10px;
            background: #1E90FF;
            border-radius: 4px;
            color: white !important;
        }
        .navbar-custom .nav > li > a:hover {
            background: #4682B4;
        }
    </style>
</head>
<body>
    <div id="app">
        {{-- ▼ 共通ヘッダー --}}
        @if (!in_array(Route::currentRouteName(), [
    'login',
    'register',
    'admin.login',
    'admin.register.form',
    'user.login.form',
    'user.register.form'
    ]))
        <nav class="navbar navbar-custom">
            <div class="container-fluid d-flex justify-content-between">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <ul class="nav navbar-nav">
                    <li><a href="{{ route('user.show.curriculum.list') }}">授業管理</a></li>
                    <li><a href="#">お知らせ管理</a></li>
                    <li><a href="#">バナー管理</a></li>
                    <li><a href="{{ url()->previous() }}">戻る</a></li>
                </ul>

               

                <ul class="nav navbar-nav navbar-right">


               < class="nav navbar-nav navbar-right">
                @guest('user')
                    {{-- 追加：userガード用のログイン/登録ボタン --}}
                    <li>
                        <a href="{{ route('user.login.form') }}" class="btn btn-primary navbar-btn">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('user.register.form') }}" class="btn btn-default navbar-btn">Register</a>
                    </li>
                @else
                    {{-- 追加：ユーザー名表示（右端） --}}
                    

                    {{-- 追加：ログアウト（POSTフォームで確実に実行） --}}
                    
                @endguest
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @endif

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @endif
                    @else
                    {{-- ▼ ログアウト --}}
                    <li class="navbar-text" style="margin-right:10px;">
                        {{ Auth::guard('user')->user()->name }} <!-- 追加 -->
                    </li>
                            <li>
                                <a href="{{ route('user.logout') }}"
                                class="btn btn-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @auth('user')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    {{ Auth::guard('user')->user()->name }} <span class="caret"></span>
                                </a>
                            </li>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        
                                    </a>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" >
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endauth
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        @endif

        {{-- ▼ 各ページの中身 --}}
        <main class="container">
            @yield('content')
        </main>
    </div>

    <!-- jQuery + Bootstrap3 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>