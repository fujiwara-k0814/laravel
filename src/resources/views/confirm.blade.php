@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2 class="confirm__title">Confirm</h2>
    </div>
    <form action="/thanks" class="form" method="POST">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        {{ $contact['last_name'] }}
                        <span class="space"></span>
                        {{ $contact['first_name'] }}
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @php
                            $genderLabels = [
                                1 => '男性',
                                2 => '女性',
                                3 => 'その他'
                            ];
                        @endphp
                        {{ $genderLabels[$contact['gender']] }}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        @php
                            $categoryLabels = [
                                1 => '商品のお届けについて',
                                2 => '商品の交換について',
                                3 => '商品トラブル',
                                4 => 'ショップへのお問い合わせ',
                                5 => 'その他'
                            ];
                        @endphp
                        {{ $categoryLabels[$contact['category_id']] }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button type="submit" class="form__button-submit">送信</button>
        </div>
    </form>
    <form action="/" method="POST">
        @csrf
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building" value="{{ $contact['building'] }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
        <div class="edit__button">
            <button type="submit" class="edit__button-submit">修正</button>
        </div>
    </form>
</div>
@endsection