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
    
</div>
@endsection