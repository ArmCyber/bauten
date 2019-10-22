@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.partner_group_changed.message') }}</p>
    <p>Новый статус: <b>{{ $partner_group->title }}</b></p>
    <p>Скидка: <b>{{ $partner_group->sale }}%</b></p>
@endsection
