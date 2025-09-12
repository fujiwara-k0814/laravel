@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset("css/register.css") }}">
@endsection

@section('header-button')
<div class="header-button__item">
    <a href="/login" class="header-button__link">login</a>
</div>
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2 class="register__title">Register</h2>
    </div>
    <div class="register-form__content">
        <form action="/register" class="form" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="例: 山田  太郎" value="{{ old('name') }}">
                    </div>
                    <div class="form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
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
                <div class="form__group-title">
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
                <button type="submit" class="form__button-submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection