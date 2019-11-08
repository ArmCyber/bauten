@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        @breadcrumb(['pages'=>[['title'=>'Регистрация']]])@endbreadcrumb
        <div class="registration-page row">
            <div class="col-12 col-lg-6">
                <div class="registration-greetings">
                    <h1 class="registration-title">{{ $banners->register->first_title }}</h1>
                    <div class="registration-text dynamic-text">{!! $banners->register->first_text !!}</div>
                </div>
                <div class="registration-block">
                    <form action="{{ route('register') }}" method="post">@csrf
                        <div class="registration-type">
                            <div>Регистрируюсь как</div>
                            <div class="c-radios">
                                <label class="c-radio">
                                    <input type="radio" id="legal-person-radio" class="reg-type-radio" name="type" value="{{ $types['entity'] }}" {{ old('type')!=$types['individual']?'checked':null }}>
                                    <span>Компания</span>
                                </label>
                                <label class="c-radio">
                                    <input type="radio" name="type" class="reg-type-radio" value="{{ $types['individual'] }}" {{ old('type')==$types['individual']?'checked':null }}>
                                    <span>Физическое лицо</span>
                                </label>
                            </div>
                            <div class="c-inputs  {{ old('type')!=$types['individual']?'lp-checked':null }}">
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-region">Регион</label></div>
                                    <div class="c-control">
                                        <input type="text" id="form-region" name="region" maxlength="255" value="{{ old('region') }}" @error('region') class="has-error" @enderror>
                                    </div>
                                </div>
                                @error('region')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-city">Город</label></div>
                                    <div class="c-control">
                                        <input type="text" id="form-city" name="city" maxlength="255" value="{{ old('city') }}" @error('city') class="has-error" @enderror>
                                    </div>
                                </div>
                                @error('city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-name">ФИО</label></div>
                                    <div class="c-control"><input type="text" id="form-name" name="name" maxlength="255" value="{{ old('name') }}" @error('name') class="has-error" @enderror></div>
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
{{--                                <div class="c-form-group">--}}
{{--                                    <div class="c-label"><label for="form-lname">Фамилия</label></div>--}}
{{--                                    <div class="c-control"><input type="text" id="form-lname" name="last_name" maxlength="255" value="{{ old('last_name') }}" @error('last_name') class="has-error" @enderror></div>--}}
{{--                                </div>--}}
{{--                                @error('last_name')--}}
{{--                                <small class="text-danger">{{ $message }}</small>--}}
{{--                                @enderror--}}
                                <div class="c-form-group lp-only">
                                    <div class="c-label"><label for="form-company">Компания</label></div>
                                    <div class="c-control"><input type="text" id="form-company" name="company" maxlength="255" value="{{ old('company') }}" @error('company') class="has-error" @enderror></div>
                                </div>
                                @error('company')
                                <small class="text-danger lp-only">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group lp-only">
                                    <div class="c-label"><label for="form-bin">БИН</label></div>
                                    <div class="c-control"><input type="text" id="form-bin" name="bin" maxlength="255" value="{{ old('bin') }}" @error('bin') class="has-error" @enderror></div>
                                </div>
                                @error('bin')
                                <small class="text-danger lp-only">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-phone">Телефон</label></div>
                                    <div class="c-control"><input type="text" id="form-phone" name="phone" maxlength="255" value="{{ old('phone') }}" @error('phone') class="has-error" @enderror></div>
                                </div>
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-email">E-mail</label></div>
                                    <div class="c-control"><input type="text" id="form-email" name="email" maxlength="255" value="{{ old('email') }}" @error('email') class="has-error" @enderror></div>
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-password">Пароль</label></div>
                                    <div class="c-control"><input type="password" id="form-password" name="password" maxlength="255" @error('password') class="has-error" @enderror></div>
                                </div>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-password-confirmation">Повторите пароль</label></div>
                                    <div class="c-control"><input type="password" id="form-password-confirmation" name="password_confirmation" maxlength="255"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-manager">ID Менеджера</label></div>
                                    <div class="c-control"><input type="text" id="form-manager" name="manager" maxlength="255" value="{{ old('manager') }}" placeholder="Оставьте пустое если нет менеджера" @error('manager') class="has-error" @enderror></div>
                                </div>
                                @error('manager')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="c-form-group">
                                    <div class="c-label d-none d-lg-block"></div>
                                    <div class="c-control text-center text-lg-right"><button type="submit" class="bauten-btn">Подтвердить</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                <div class="registration-terms">
                    @foreach($banners->register_right as $banner)
                        <div class="registration-term">
                            <div class="term-title">{{ $banner->title }}</div>
                            <div class="term-content">
                                <div class="term-description">{!! $banner->text !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
@push('js')
    @js(aSite('js/registration.js'))
@endpush
