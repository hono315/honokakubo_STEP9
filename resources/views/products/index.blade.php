@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div>
    <h1 class="ms-3">商品一覧</h1>

    <form id="search-form" action="" method="GET" class="row g-2 justify-content-center align-items-center mb-5 mx-auto w-75">

        <div class="col-4">
            <input type="text" name="search" class="form-control" placeholder="商品名を入力" value="{{ request('search') }}">
        </div>

        <div class="col-3">
            <input type="number" name="min_price" class="form-control" placeholder="最低価格" value="{{ request('min_price') }}">
        </div>

        <div class="col-auto text-center">
            <span>〜</span>
        </div>

        <div class="col-3">
            <input type="number" name="max_price" class="form-control" placeholder="最高価格" value="{{ request('max_price') }}">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary px-4">検索</button>
        </div>

    </form>

    <div id="items-area">
        @include('products.partials.items')
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/products-search.js') }}"></script>
@endsection