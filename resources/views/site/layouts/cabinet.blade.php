@extends('site.layouts.app')
@section('main')
    <div class="container pt-2s pb-s">
        <div class="cabinet-row">
            <div class="cabinet-left">
                <div class="cabinet-sidebar">
                    <div class="cs-head">
                        <div class="cs-avatar"><span class="avatar-image"></span></div>
                        <div class="cs-name">{{ $user->name }} {{ $user->last_name }}</div>
                        <div class="cs-region">{{ $user->country_name }}, {{ $user->region_name }}</div>
                    </div>
                    <div class="cs-links">
                        @component('site.components.cabinet_link', ['route'=>'cabinet.main', 'title'=>'Главная'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>null, 'title'=>'Корзина'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>null, 'title'=>'Сохроненные'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>null, 'title'=>'Покупки'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>'cabinet.profile', 'title'=>'Профиль'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>null, 'title'=>'Выход', 'class'=>'action-logout'])@endcomponent
                    </div>
                </div>
            </div>
            <div class="cabinet-right">@yield('content')</div>
        </div>
    </div>
@endsection
