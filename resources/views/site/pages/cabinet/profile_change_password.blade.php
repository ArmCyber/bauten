@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Изменение пароля</div>
    <div class="cabinet-form pt-3">
        <form action="{{ route('cabinet.profile.change_password') }}" method="post" autocomplete="off">@csrf
            <div class="cabinet-form-row">
                <div class="cabinet-form-col">
                    <div class="form-group">
                        <label for="form-new-password">Новый пароль</label>
                        <input type="password" id="form-new-password" class="form-control @error('new_password') has-error @enderror" name="new_password" maxlength="255">
                        @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="form-new-password-confirmation">Повторите пароль</label>
                        <input type="password" id="form-new-password-confirmation" class="form-control" name="new_password_confirmation" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="form-password">Текущий пароль</label>
                        <input type="password" id="form-password" class="form-control @error('password') has-error @enderror" name="password" maxlength="255">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-bauten">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
