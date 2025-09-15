@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-button')
<div class="header-button__item">
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="header-button__logout">logout</button>
    </form>
</div>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2 class="admin__title">Admin</h2>
    </div>
    <div class="admin-search__content">
        <form action="/admin/search" class="search-form" method="get">
            @csrf
            <div class="search__group">
                <div class="search__input-keyword">
                    <input 
                        type="text" 
                        name="keyword" 
                        placeholder="名前やメールアドレスを入力してください" 
                        value="{{ old('keyword', request('keyword')) }}"
                    >
                </div>
                <div class="search__select-gender">
                    <select name="gender" class="select-gender__item">
                        <option value="" hidden>性別</option>
                        <option 
                            value="-1" 
                            {{ old('gender', request('gender')) == -1 ? 'selected' : "" }}
                            >全て
                        </option>
                        <option 
                            value="1" 
                            {{ old('gender', request('gender')) == 1 ? 'selected' : "" }}
                            >男性
                        </option>
                        <option 
                            value="2" 
                            {{ old('gender', request('gender')) == 2 ? 'selected' : "" }}
                            >女性
                        </option>
                        <option 
                            value="3" 
                            {{ old('gender', request('gender')) == 3 ? 'selected' : "" }}
                            >その他
                        </option>
                    </select>
                </div>
                <div class="search__select-content">
                    <select name="category_id" class="select-contact__item">
                        <option value="" hidden>お問い合わせの種類</option>
                        <option 
                            value="1" 
                            {{ old('category_id', request('category_id')) == 1 ? 'selected' : "" }}
                            >商品のお届けについて
                        </option>
                        <option 
                            value="2" 
                            {{ old('category_id', request('category_id')) == 2 ? 'selected' : "" }}
                            >商品の交換について
                        </option>
                        <option 
                            value="3" 
                            {{ old('category_id', request('category_id')) == 3 ? 'selected' : "" }}
                            >商品トラブル
                        </option>
                        <option 
                            value="4" 
                            {{ old('category_id', request('category_id')) == 4 ? 'selected' : "" }}
                            >ショップへのお問い合わせ
                        </option>
                        <option 
                            value="5" 
                            {{ old('category_id', request('category_id')) == 5 ? 'selected' : "" }}
                            >その他
                        </option>
                    </select>
                </div>
                <div class="search__select-date">
                    <input 
                        type="date" 
                        name="date" 
                        value="{{ old('date', request('date')) }}"
                    >
                </div>
                <div class="search-form__button">
                    <button 
                        type="submit"
                        class="search-form__button-submit"
                        >検索
                    </button>
                </div>
                <div class="search-reset__button">
                    <a href="/admin" class="reset-button">リセット</a>
                </div>
            </div>
        </form>
    </div>
    <div class="admin-action__content">
        <form action="/admin/export" method="get" class="export-form">
            @csrf
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <div class="action-export__button">
                <button 
                    type="submit" 
                    class="action-export__button-submit"
                    >エクスポート
                </button>
            </div>
        </form>

        {{-- ページネーション処理 --}}
        @php
        $currentPage = request()->get('page', 1);
        $totalPages = $contacts->lastPage();
        $groupSize = 5;
        $startPage = floor(($currentPage - 1) / $groupSize) * $groupSize + 1;
        $endPage = min($startPage + $groupSize - 1, $totalPages);

        $query = request()->only(['keyword', 'gender', 'category_id', 'date']);
        @endphp

        <nav class="pagination">
            <ul>
                <li>
                {{-- 前のグループ処理 --}}
                @if ($startPage > 1)
                    <a 
                        href="{{ request()->fullUrlWithQuery(array_merge($query, ['page' => $startPage - 1])) }}"
                        ><
                    </a>
                @else
                    <a href="#" class="disabled"><</a>
                @endif
                </li>
                {{-- ページ番号処理 --}}
                @for ($i = $startPage; $i <= $endPage; $i++)
                <li>
                    <a 
                        href="{{ request()->fullUrlWithQuery(array_merge($query, ['page' => $i])) }}"
                        class="{{ $i == $currentPage ? 'is-active' : '' }}"
                        >{{ $i }}
                    </a>
                </li>
                @endfor
                {{-- 次のグループ処理 --}}
                <li>
                @if ($endPage < $totalPages)
                    <a 
                        href="{{ request()->fullUrlWithQuery(array_merge($query, ['page' => $endPage + 1])) }}"
                        >>
                    </a>
                @else
                    <a href="#" class="disabled">></a>
                @endif
                </li>
            </ul>
        </nav>
        

    </div>
    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__row">
                <th class="admin-table__title">お名前</th>
                <th class="admin-table__title">性別</th>
                <th class="admin-table__title">メールアドレス</th>
                <th class="admin-table__title">お問い合わせの種類</th>
                <th class="admin-table__title"></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__text">
                    {{ $contact->last_name }}
                    <span class="admin-space"></span>
                    {{ $contact->first_name }}
                </td>
                <td class="admin-table__text">
                    {{ $contact->gender_label }}
                </td>
                <td class="admin-table__text">
                    {{ $contact->email }}
                </td>
                <td class="admin-table__text">
                    {{ $contact->category_label }}
                </td>
                <td class="admin-table__text">
                    <a 
                        href="#modal-{{ $contact->id }}" 
                        class="detail-link__button"
                        >詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @foreach ($contacts as $contact)
        <div class="admin-modal" id="modal-{{ $contact->id }}">
            <div class="modal__wrapper">
                <div class="admin-modal__content">
                    <a href="#" class="admin-modal__close">×</a>
                    <table class="modal-table">
                        <tr class="modal-table__row">
                            <th class="modal-table__title">お名前</th>
                            <td class="modal-table__text">
                                {{ $contact->last_name }}
                                <span class="modal-space"></span>
                                {{ $contact->first_name }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">性別</th>
                            <td class="modal-table__text">
                                {{ $contact->gender_label }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">メールアドレス</th>
                            <td class="modal-table__text">
                                {{ $contact->email }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">電話番号</th>
                            <td class="modal-table__text">
                                {{ $contact->tel }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">住所</th>
                            <td class="modal-table__text">
                                {{ $contact->address }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">建物名</th>
                            <td class="modal-table__text">
                                {{ $contact->building }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">お問い合わせの種類</th>
                            <td class="modal-table__text">
                                {{ $contact->category_label }}
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__title">お問い合わせ内容</th>
                            <td class="modal-table__text">
                                {{ $contact->detail }}
                            </td>
                        </tr>
                    </table>
                </div>
                <form action="/admin/delete" method="post" class="delete-form">
                    @method('DELETE')
                    @csrf
                    <div class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection