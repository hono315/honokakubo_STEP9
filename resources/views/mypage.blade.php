@extends('layouts.app')

@section('title', 'マイページ')

@section('content')

    <div class="mx-auto w-75 text-start">

        <h1 class="mb-3">マイページ</h1>

        <a href="{{ route('users.edit') }}" class="text-center mb-2">
            @csrf
            <button class="btn btn-primary btn-sm mt-1 ms-3">
                アカウント編集
            </button>
        </a>

        <div class="d-flex mt-2">
            <div class="ms-3">
                <p>ユーザー名: {{ $user->name }}</p>
                <p>メールアドレス: {{ $user->email }}</p>
            </div>

            <div class="ms-4">
                <p>名前:{{ $user->name_kanji }}</p>
                <p>カナ:{{ $user->name_kana }}</p>
            </div>
        </div>

        <div>
            <p class="fs-5 fw-bold mb-3">
                <出品商品>
            </p>
            <div class="d-flex justify-content-end mx-auto w-75 mb-2">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    新規登録
                </a>
            </div>
            <table class="table align-middle text-start mb-5">
                <thead>
                    <tr>
                        <th>商品番号</th>
                        <th>商品名</th>
                        <th>商品説明</th>
                        <th>料金</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <a href="{{ route('products.exhibit_detail', ['item' => $item->id]) }}" class="btn btn-success btn-sm">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p class="fs-5 fw-bold mb-3">
                <購入した商品>
            </p>
            <table class="table align-middle text-start">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>商品説明</th>
                        <th>料金</th>
                        <th>個数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->salesProducts as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->pivot->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection