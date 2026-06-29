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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <header class="d-flex justify-content-between align-items-center p-3 mb-4 ">

            <div>
                <h3>Cytech EC</h3>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3 mb-4">

                <div class="text-info me-3">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </div>

                <div class="text-info me-3">
                    <a href="{{ route('mypage') }}" class="text-decoration-none">マイページ</a>
                </div>

                @auth
                <div class="me-3">
                    <p class="mb-0">ログインユーザー: {{ Auth::user()->name }}</p>
                </div>
                @endauth

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm mt-1">
                        ログアウト
                    </button>
                </form>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="mt-5">
            <div>
                <form action="{{ route('contact.index') }}" method="GET" class="text-center mb-2">
                    @csrf
                    @csrf
                    <button  class="btn btn-primary btn-sm mt-1">
                        お問い合わせ
                    </button>
                </form>
            </div>
            <div class="d-flex justify-content-center align-items-center mb-1 text-info">
                <div class="p-1">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </div>

                <div class="p-1">
                    <a href="{{ route('mypage') }}" class="text-decoration-none">マイページ</a>
                </div>
            </div>

            <div class="text-center">
                © 2024 Cytech EC
            </div>
        </footer>
    </div>
</body>

</html>