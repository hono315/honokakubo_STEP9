@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<script src="{{ asset('js/like.js') }}?v={{ time() }}"></script>
<div class="container">
    <h1>商品詳細</h1>

    <div class="d-flex flex-column align-items-center  w-100 ">
        <div>
            <p>商品名:{{$item->product_name}}</p>
            <p>説明:{{$item->description}}</p>
            <P>画像:<img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" style="max-width: 300px;"></P>
            <p>価格:{{$item->price}}円</p>
            <p>会社名:{{ $item->company->company_name}}</p>
        </div>

        <div class="mb-3">
            <button id="like-button" class="border-0 bg-transparent p-0" data-item-id="{{ $item->id }}">
                <i class="fas fa-heart" style="color: {{ auth()->check() && $item->isLikedBy(auth()->user()) ? 'red' : 'black' }};"></i>
            </button>
        </div>

        <div class="d-flex justify-content-center gap-2">

            <a href="{{ route('products.checkout', ['item' => $item->id]) }}" class="btn btn-primary">
                カートに追加する
            </a>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                戻る
            </a>

        </div>
    </div>
</div>
@endsection