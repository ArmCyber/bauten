@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        @breadcrumb(['pages'=>[['title'=>'Вход']]])@endbreadcrumb
        <h1 class="page-title">Вход</h1>
        <div class="login-form">
            @if(session('action')=='registered')
                <p class="text-center text-success">{{ __('texts.registered') }}</p>
            @endif
            <form action="{{ route('login') }}" method="post">@csrf
                <div class="c-inputs">
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-email">E-mail</label></div>
                        <div class="c-control"><input type="text" id="form-email" name="email" maxlength="255" @error('email') class="has-error" @enderror value="{{ old('email') }}"></div>
                    </div>
                    @error('email')
                    <div class="text-center">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-password">Пароль</label></div>
                        <div class="c-control"><input type="password" id="form-password" @error('email') class="has-error" @enderror name="password" maxlength="255"></div>
                    </div>
                    @error('password')
                    <div class="text-center">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="c-form-group">
                        <div class="c-control text-center"><button type="submit" class="bauten-btn">Войти</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
