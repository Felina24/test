@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('body-class', 'login-page')

@section('header-extra')
    <a href="{{ route('login') }}" class="login-button">login</a>
@endsection

@section('content')
    <h2 class="page-title">Register</h2>

    <main class="main-container">
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-box">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">名前</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田太郎">
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: example@mail.com">
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" placeholder="8文字以上の英数字">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">パスワード確認</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="パスワードを再入力">
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-btn">登録</button>
                </div>
            </form>
        </div>
    </main>
@endsection