@extends('site.mails.layout')
@section('content')
    <p>Новый пользователь на сайте Bauten.org.</p>
    <p>Адрес эл.почты: {{ $email }}</p>
@endsection
