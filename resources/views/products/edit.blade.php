@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<div class="container">
    <h1 class="mb-4">出品商品編集</h1> {{-- 少し下に余白を入れました --}}

    <form action="{{ route('products.update', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $item->product_name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required min="0">
        </div>  
        
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
        </div>  
        
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $item->stock }}" required min="0">
        </div>  
        
        <div class="mb-3">
            <label for="image_path" class="form-label">商品画像</label>
            @if($item->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="現在の画像" style="max-width: 150px;" class="img-thumbnail">
                </div>
            @endif
            <input type="file" class="form-control" id="image_path" name="image_path">
        </div>  

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">更新</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">戻る</button>
        </div>
    </form>
</div>
@endsection