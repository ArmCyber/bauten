@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <h1 class="page-title mt-2">Активация профиля</h1>
        <div class="login-form">
            <p class="text-center">{{ __('texts.check manager') }}</p>
            @error('manager')
            <p class="text-danger text-center">{{ $message }}</p>
            @enderror
            <form action="{{ url()->current() }}" method="post">@csrf
                <div class="c-inputs">
                    <div class="c-form-group">
                        <div class="c-label"><label for="form-manager">Менеджер</label></div>
                        <div class="c-control"><input type="text" id="form-manager" name="manager" maxlength="255" value="{{ old('manager') }}"></div>
                    </div>
                    <div class="c-form-group">
                        <div class="c-control d-flex justify-content-center">
                            <button type="submit" name="skip" value="1" class="bauten-btn mr-2">Пропустить</button>
                            <button type="submit" class="bauten-btn">Привязать</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
