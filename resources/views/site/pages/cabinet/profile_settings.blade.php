@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Изменение личных данных</div>
    <div class="cabinet-form pt-3">
        <form action="{{ route('cabinet.profile.settings') }}" method="post">@csrf
            <div class="cabinet-form-row">
                <div class="cabinet-form-col">
                    <div class="form-group">
                        <label for="form-name">ФИО</label>
                        <input type="text" id="form-name" class="form-control @error('name') has-error @enderror" name="name" value="{{ old('name', $user->name) }}" maxlength="255">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="form-last-name">Фамилия</label>--}}
{{--                        <input type="text" id="form-last-name" class="form-control @error('last_name') has-error @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" maxlength="255">--}}
{{--                        @error('last_name')--}}
{{--                        <small class="text-danger">{{ $message }}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="form-phone">Телефон</label>
                        <input type="text" id="form-phone" class="form-control @error('phone') has-error @enderror" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="255">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @if($user->isEntity)
                        <div class="form-group">
                            <label for="form-company">Компания</label>
                            <input type="text" id="form-company" class="form-control @error('company') has-error @enderror" name="company" value="{{ old('company', $user->company) }}" maxlength="255">
                            @error('company')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="form-bin">БИН</label>
                            <input type="text" id="form-bin" class="form-control @error('bin') has-error @enderror" name="bin" value="{{ old('bin', $user->bin) }}" maxlength="255">
                            @error('bin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="cabinet-form-col">
                    <div class="form-group">
                        <label for="form-region">Регион</label>
                        <input type="text" id="form-region" class="form-control @error('region') has-error @enderror" name="region" value="{{ old('region', $user->region) }}" maxlength="255">
                        @error('region')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="form-city">Город</label>
                        <input type="text" id="form-city" class="form-control @error('city') has-error @enderror" name="city" value="{{ old('city', $user->city) }}" maxlength="255">
                        @error('city')
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
