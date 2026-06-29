@extends('layouts.app')

@section('title', '購入画面')

@section('content')

<div class="container">
    <h1>購入画面</h1>

    <form id="purchaseForm" action="{{ route('products.checkout', $item) }}" method="POST">
        @csrf

        <div>
            <p>商品名:{{$item->product_name}}</p>
            <p>説明:{{$item->description}}</p>
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" style="max-width: 300px;">
            
            <div class="my-3">
                @if($item->stock > 0)
                    <label for="quantity">数量：</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $item->stock }}" required>
                    @error('quantity')
                        <div class="text-danger" style="color: red;">{{ $message }}</div>
                    @enderror
                @else
                    <p style="color: red; font-weight: bold; margin-bottom: 0;">この商品は売り切れたため、購入できません。</p>
                @endif
            </div>
            
            <p>金額:{{$item->price}}円</p>
            <p>残り:{{$item->stock}}</p>
            <p>会社名:</p>
            
            <div class="mt-3">
                @if($item->stock > 0)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                        購入する
                    </button>
                @else
                    <button type="button" class="btn btn-secondary" disabled>売り切れ</button>
                @endif
                
                <a href="{{ route('products.detail', $item) }}" class="btn btn-secondary">戻る</a>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">購入確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                本当にこの商品を購入しますか？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-primary" id="executePurchaseBtn">確定して購入</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const executeBtn = document.getElementById('executePurchaseBtn');
        if (executeBtn) {
            executeBtn.addEventListener('click', function () {
                document.getElementById('purchaseForm').submit();
            });
        }
    });
</script>
@endsection