    <table class="table bordered-bottom text-center mx-auto w-75">
        <thead class="text-center">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(¥)</th>
                <th></th>
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
                <td>
                    <a href="{{ route('products.detail', ['item' => $item->id]) }}" class="btn btn-success">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>