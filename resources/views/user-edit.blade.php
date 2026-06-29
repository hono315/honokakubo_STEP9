@extends('layouts.app')
@section('title', 'アカウント情報編集')
@section('content')

<div class="mx-auto w-50">
    <h1>アカウント情報編集</h1>

    <form action="{{ route('users.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Eメール</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name_kanji" class="form-label">名前</label>
            <input type="text" id="name_kanji" name="name_kanji" class="form-control" value="{{ old('name_kanji', $user->name_kanji) }}" required>
            @error('name_kanji')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name_kana" class="form-label">カナ</label>
            <input type="text" id="name_kana" name="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}" required>
            @error('name_kana')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新</button>
        </div>


    </form>
</div>

@endsection