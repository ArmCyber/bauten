@extends('site.layouts.app')
@section('main')
    <div class="container pt-2s pb-s">
        <div class="cabinet-row">
            <div class="cabinet-left">
                <div class="cabinet-sidebar">
                    <div class="cs-head">
                        <div class="cs-avatar"><span class="avatar-image"></span></div>
                        <div class="cs-name">{{ $user->name }}</div>
                        <div class="cs-region">{{ $user->region }}, {{ $user->city }}</div>
                    </div>
                    <div class="cs-links">
                        @component('site.components.cabinet_link', ['route'=>'cabinet.main', 'title'=>'Главная'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>'cabinet.basket'])
                            @slot('title')Корзина (<span id="sidebar-basket">{{ count($basket_part_ids) }}</span>)@endslot
                        @endcomponent
                        @component('site.components.cabinet_link', ['route'=>'cabinet.favourites', 'title'=>'Сохраненные'])@endcomponent
                        @if($pending_orders_count)
                            @component('site.components.cabinet_link', ['route'=>'cabinet.orders.pending', 'title'=>'Заказы'])@endcomponent
                        @endif
                        @component('site.components.cabinet_link', ['route'=>'cabinet.orders.done', 'title'=>'Покупки'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>'cabinet.profile', 'title'=>'Профиль'])@endcomponent
                        @component('site.components.cabinet_link', ['route'=>null, 'title'=>'Выход', 'class'=>'action-logout'])@endcomponent
                    </div>
                </div>
            </div>
            <div class="cabinet-right">@yield('content')</div>
        </div>
    </div>
@endsection
