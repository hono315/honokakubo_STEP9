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
    <h1>商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="product_name">商品名</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div>
            <label for="price">価格</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div>
            <label for="description">商品説明</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="stock">在庫数</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div>
            <label for="image">画像:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" onclick="history.back()">戻る</button>
        <button type="submit">登録</button>
    </form>
</div>