@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Настройки профиля</div>
    <div class="cabinet-block">
        <div class="cabinet-block-title">Ваши данные</div>
        @if(session('notify') == 'changes_saved')
            <div class="pt-1">
                <div class="text-success font-weight-middle">Изменении сохранены.</div>
            </div>
        @endif
        <div class="cabinet-block-content">
            <div class="cabinet-block-info">Тип: <b>{{ $user->type_name }}</b></div>
            <div class="cabinet-block-info">Имя: <b>{{ $user->name }}</b></div>
            <div class="cabinet-block-info">Фамилия: <b>{{ $user->last_name }}</b></div>
            <div class="cabinet-block-info">E-mail: <b>{{ $user->email }}</b></div>
            <div class="cabinet-block-info">Телефон: <b>{{ $user->phone }}</b></div>
            @if($user->is_entity)
                <div class="cabinet-block-info">Компания: <b>{{ $user->company }}</b></div>
                <div class="cabinet-block-info">БИН: <b>{{ $user->bin }}</b></div>
            @endif
            <div class="cabinet-block-info">Страна: <b>{{ $user->country_name }}</b></div>
            <div class="cabinet-block-info">Регион: <b>{{ $user->region_name }}</b></div>
            <div class="cabinet-block-info">Город: <b>{{ $user->city }}</b></div>
            <div class="pt-3">
                <a href="{{ route('cabinet.profile.settings') }}" class="bauten-btn">Изменить личные данные</a>
                <a href="#" class="bauten-btn">Изменить e-mail</a>
                <a href="{{ route('cabinet.profile.change_password') }}" class="bauten-btn">Изменить пароль</a>
            </div>
        </div>
    </div>
    @if($user_manager)
        <div class="cabinet-block">
            <div class="cabinet-block-title">Данные вашего менеджера</div>
            <div class="cabinet-block-content">
                @if($user_manager->code)
                    <div class="cabinet-block-info">ID: <b>{{ $user_manager->code }}</b></div>
                @endif
                <div class="cabinet-block-info">Имя: <b>{{ $user_manager->name }}</b></div>
                <div class="cabinet-block-info">E-mail: <b>{{ $user_manager->email }}</b></div>
                <div class="cabinet-block-info">Телефон: <b>{{ $user_manager->phone }}</b></div>
            </div>
        </div>
    @endif
@endsection
