@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.register.message') }}</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
@endsection
