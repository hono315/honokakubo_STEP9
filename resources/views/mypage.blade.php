<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @include('layouts.header')
    <h1 class="ms-3">マイページ</h1>

    <a href="{{ route('users.edit') }}" class="text-center mb-2">
        @csrf
        <button class="btn btn-primary btn-sm mt-1">
            アカウント編集
        </button>
    </a>

    <div>
        <div>
            <p>ユーザー名: {{ $user->name }}</p>
            <p>メールアドレス: {{ $user->email }}</p>
        </div>

        <div>
            <p>名前:{{ $user->name_kanji }}</p>
            <p>カナ:{{ $user->name_kana }}</p>
        </div>
    </div>

    <div>
        <p>
            <出品商品>
        </p>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-1">
            新規登録
        </a>
        <table class="table bordered-bottom text-center mx-auto w-75">
            <thead class="text-center">
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('products.detail', ['item' => $item->id]) }}" class="btn btn-outline-primary btn-sm">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <p><購入した商品></p>
        <table class="table bordered-bottom text-center mx-auto w-75">
            <thead class="text-center">
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金</th>
                    <th>個数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->salesProducts as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @include('layouts.footer')
</body>

</html>