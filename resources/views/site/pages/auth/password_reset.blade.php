@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <h1 class="page-title">Восстоновление пароля</h1>
        <div class="login-form">
            <form action="{{ route('password.reset', ['email'=>$email, 'token'=>$token]) }}" method="post">@csrf
                <div class="c-inputs">
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-email">E-mail</label></div>
                        <div class="c-control"><input type="text" id="form-email" value="{{ $email }}" disabled></div>
                    </div>
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-password">Новый пароль</label></div>
                        <div class="c-control"><input type="password" id="form-password" @error('password') class="has-error" @enderror name="password" maxlength="255"></div>
                    </div>
                    @error('password')
                    <div class="text-center">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-password-confirmation">Повторите пароль</label></div>
                        <div class="c-control"><input type="password" id="form-password-confirmation" name="password_confirmation" maxlength="255"></div>
                    </div>
                    <div class="c-form-group">
                        <div class="c-control text-center"><button type="submit" class="bauten-btn">Войти</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
