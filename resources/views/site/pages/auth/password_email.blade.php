@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <h1 class="page-title">Восстоновление пароля</h1>
        <div class="login-form">
            @if(session()->has('action'))
                <p class="text-center text-success">{{ __('texts.actions.'.session('action')) }}</p>
            @endif
            @error('global')
                <p class="text-center text-danger">{{ $message }}</p>
            @enderror
            <form action="{{ route('password.email') }}" method="post">@csrf
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
                        <div class="c-control text-center"><button type="submit" class="bauten-btn">Продолжить</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
