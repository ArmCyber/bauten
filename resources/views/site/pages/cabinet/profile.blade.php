@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Настройки профиля</div>
    <div class="cabinet-block">
        <div class="cabinet-block-title">Ваши данные</div>
        @if(($notify = session('notify')) == 'changes_saved')
            <div class="pt-1">
                <div class="text-success font-weight-middle">Изменении сохранены.</div>
            </div>
        @elseif($notify == 'email_sent')
            <div class="pt-1">
                <div class="text-success font-weight-middle">Ссылка подверждения нового эл.адреса отправлена на эл.почту.</div>
            </div>
        @elseif($notify == 'change_email_canceled')
            <div class="pt-1">
                <div class="text-success font-weight-middle">Заявка измениния эл.адреса отменена.</div>
            </div>
        @endif
        <div class="cabinet-block-content">
            <div class="cabinet-block-info">Тип: <b>{{ $user->type_name }}</b></div>
            <div class="cabinet-block-info">ФИО: <b>{{ $user->name }}</b></div>
{{--            <div class="cabinet-block-info">Фамилия: <b>{{ $user->last_name }}</b></div>--}}
            <div class="cabinet-block-info">E-mail: <b>{{ $user->email }}
                @if($change_email)
                    <span class="text-warning">({{ $change_email->email }})</span>
                @endif
            </b></div>
            <div class="cabinet-block-info">Телефон: <b>{{ $user->phone }}</b></div>
            @if($user->is_entity)
                <div class="cabinet-block-info">Компания: <b>{{ $user->company }}</b></div>
                <div class="cabinet-block-info">БИН: <b>{{ $user->bin }}</b></div>
            @endif
            <div class="cabinet-block-info">Регион: <b>{{ $user->region }}</b></div>
            <div class="cabinet-block-info">Город: <b>{{ $user->city }}</b></div>
            <div class="pt-3">
                <a href="{{ route('cabinet.profile.settings') }}" class="bauten-btn mt-1">Изменить личные данные</a>
                @if(!$change_email)
                    <a href="{{ route('cabinet.profile.change_email') }}" class="bauten-btn mt-1">Изменить e-mail</a>
                @else
                    <a href="{{ route('cabinet.profile.change_email.cancel') }}" class="bauten-btn mt-1">Отменить новый e-mail</a>
                @endif
                <a href="{{ route('cabinet.profile.change_password') }}" class="bauten-btn mt-1">Изменить пароль</a>
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
