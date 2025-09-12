@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-button')
<div class="header-button__item">
    <a href="/register" class="header-button__link">register</a>
</div>
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <h2 class="login__title">Login</h2>
    </div>
    <div class="login-form__content">
        <form action="/login" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-taitle">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-taitle">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="例: coachtech1106">
                    </div>
                    <div class="form__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button type="submit" class="form__button-submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection