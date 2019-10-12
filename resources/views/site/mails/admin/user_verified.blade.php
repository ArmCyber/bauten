@extends('site.mails.layout')
@section('content')
    <p>Пользователь "{{ $email }}" активировал свой профиль.</p>
    <p>Привязанный менеджер: {{ $manager?$manager->email:'нет' }}</p>
@endsection
