<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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

            <div class="me-3">
                <p class="mb-0">ログインユーザー: {{ Auth::user()->name }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm mt-1">
                    ログアウト
                </button>
            </form>
        </div>
    </header>
</body>

</html>