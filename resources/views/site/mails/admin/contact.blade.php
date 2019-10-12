@extends('site.mails.layout')
@section('content')
    <p><strong>Имя:</strong> {{ $name }}</p>
    <p><strong>Эл.почта:</strong> {{ $email }}</p>
    <p><strong>Телефон:</strong> {{ $phone }}</p>
    <div>
        <strong>Сообщение:</strong>
        <p>{{ $text }}</p>
    </div>
@endsection
