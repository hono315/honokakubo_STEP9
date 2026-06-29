@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')

<div class="container w-50">
    <h1 class="mb-4">お問い合わせフォーム</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <label class="form-label" for="name">名前</label>
        <input type="text" class="form-control mb-3" id="name" name="name"
            value="{{ old('name') }}">

        <label class="form-label" for="email">メールアドレス</label>
        <input type="email" class="form-control mb-3" id="email" name="email"
            value="{{ old('email') }}" >

        <label class="form-label" for="message">お問い合わせ内容</label>
        <textarea class="form-control mb-3" id="message" name="message">{{ old('message') }}</textarea>

        <button type="submit" class="btn btn-primary">送信</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>

@endsection