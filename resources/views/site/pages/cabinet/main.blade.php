@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <h1 class="page-title">Кабинет</h1>
        <div class="pt-5 text-center">
            <form action="{{ route('logout') }}" method="post">
                <button type="submit" class="bauten-btn">Выйти</button>
            </form>
        </div>
    </div>
@endsection
