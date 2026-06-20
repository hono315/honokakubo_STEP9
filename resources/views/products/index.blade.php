<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<div>
    @include('layouts.header')
    <h1 class="ms-3">商品一覧</h1>

    <table class="table bordered-bottom text-center mx-auto w-75">
        <thead class="text-center">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>        
                <th>画像</th>        
                <th>料金(¥)</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->description }}</td>  
                    <td><img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->product_name }}" width="100"></td>
                    <td>{{ $item->price }}</td>
                </tr>
        @endforeach
        </tbody>         
    </table>
    @include('layouts.footer')
</div>
