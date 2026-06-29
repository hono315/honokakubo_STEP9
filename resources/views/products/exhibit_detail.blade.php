@extends('layouts.app')

@section('title', '出品商品詳細')

@section('content')
<script src="{{ asset('js/like.js') }}"></script>

<div class="container">
    <h1>出品商品詳細</h1>

    <div>
        <p>商品名:{{$item->product_name}}</p>
        <p>説明:{{$item->description}}</p>
        <P>画像:<img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" style="max-width: 300px;"></P>
        <p>価格:{{$item->price}}円</p>
        <p>会社名:</p>
    </div>


<div class="d-flex gap-2"> 
    <a href="{{ route('products.edit', ['item' => $item->id]) }}" class="btn btn-secondary">
        編集
    </a>

    <form action="{{ route('products.destroy', ['item' => $item->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE') 
        <button type="submit" class="btn btn-danger">削除する</button> 
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        戻る
    </a>

</div>
</div>
@endsection
