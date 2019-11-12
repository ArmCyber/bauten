@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Добро пожаловать</div>
    <div class="py-3">
        <div class="cabinet-key">Ваш последный вход: <b>{{ $user->logged_in_at->format('d.m.Y H:i') }}</b></div>
    </div>
    @if ($user->individual_sale)
        <div class="pt-3 cabinet-border">
            <div class="cabinet-info">У вас индивидуальная скидка в размере <b>{{ $user->individual_sale }}%</b>.</div>
        </div>
    @else
        <div class="pt-3 cabinet-border">
            <div class="cabinet-info">Ваш текуший статус партнера: <b>{{ $partner_group->title }}</b> со скидкой <b>{{ $partner_group->sale }}%</b></div>
            @if($next_partner_group)
                <div class="cabinet-key mt-2">Следующий уровень: <b>{{ $next_partner_group->title }} ({{ $next_partner_group->sale }}%)</b></div>
                <div class="mt-2">{!! $next_partner_group->terms !!}</div>
            @endif
        </div>
    @endif
@endsection
@push('css')
    @css(aApp('toastr/build/toastr.min.css'))
@endpush
@push('js')
    @js(aApp('toastr/build/toastr.min.js'))
    {!! Notify::render() !!}
@endpush
