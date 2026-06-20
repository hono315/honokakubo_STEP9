@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<script src="{{ asset('js/like.js') }}"></script>

<div class="container">
    <h1>商品詳細</h1>

    <div>
        <p>商品名:{{$item->product_name}}</p>
        <p>説明:{{$item->description}}</p>
        <P>画像:<img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" style="max-width: 300px;"></P>
        <p>価格:{{$item->price}}円</p>
        <p>会社名:</p>
    </div>

    <div>
        <button id="like-button" class="border-0 bg-transparent"
            data-item-id="{{ $item->id }}"
            @if($item->isLikedBy(auth()->user())) disabled @endif>
            <i class="fas fa-heart"></i>
            <span id="like-count">{{ $item->likes_count }}</span>
        </button>
    </div>

<div class="d-flex gap-2"> {{-- ボタンを横並びにし、程よい隙間（gap-2）をあけるBootstrapのクラス --}}
    
    {{-- 編集ボタン --}}
    <a href="{{ route('products.edit', ['item' => $item->id]) }}" class="btn btn-secondary">
        編集
    </a>

    {{-- 削除ボタン（フォーム形式） --}}
    <form action="{{ route('products.destroy', ['item' => $item->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE') {{-- Laravelに削除リクエストであることを伝えます --}}
        <button type="submit" class="btn btn-danger">削除する</button> {{-- 削除は目立つように赤色（btn-danger）がおすすめです --}}
    </form>

    {{-- 戻るボタン --}}
    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        戻る
    </a>

</div>
</div>
@endsection
