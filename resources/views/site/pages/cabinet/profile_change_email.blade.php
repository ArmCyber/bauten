@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Изменение адреса эл.почты</div>
    <div class="cabinet-form pt-3">
        <form action="{{ route('cabinet.profile.change_email') }}" method="post" autocomplete="off">@csrf
            <div class="cabinet-form-row">
                <div class="cabinet-form-col">
                    <div class="form-group">
                        <label for="form-new-email">Новый e-mail</label>
                        <input type="text" id="form-new-email" class="form-control @error('new_email') has-error @enderror" name="new_email" maxlength="255" value="{{ old('new_email') }}">
                        @error('new_email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
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
