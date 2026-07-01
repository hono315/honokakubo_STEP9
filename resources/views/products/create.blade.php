@extends('layouts.app')
@section('title', '商品登録')
@section('content')

<div class="mx-auto w-50">
    <h1 class="mb-4">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>
            <input type="text" id="product_name" name="product_name" class="form-control" required>
            @error('product_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" id="price" name="price" class="form-control" required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>
            <input type="number" id="stock" name="stock" class="form-control" required>
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="image" class="form-label">画像</label>
            <input type="file" id="image" name="image" accept="image/*" class="form-control" required>
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex ">
            <button type="button" class="btn btn-secondary me-2" onclick="history.back()">戻る</button>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>



@endsection