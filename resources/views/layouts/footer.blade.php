<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <footer class="mt-5">
        <div>
            <form action="{{ route('home') }}" method="GET" class="text-center mb-2">
                 @csrf
                @csrf
                <button class="btn btn-primary btn-sm mt-1">
                    お問い合わせ
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-1 text-info">
            <div class="p-1">
                <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
            </div>

              <div class="p-1">
                <a href="#" class="text-decoration-none">マイページ</a>
            </div>
        </div>

        <div  class="text-center">
            © 2024 Cytech EC
        </div>
    </footer>
</body>
</html>