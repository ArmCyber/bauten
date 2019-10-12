@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.verify.message') }}</p>
    <p><a href="{{ $url }}">{{ __('mails.verify.link') }}</a></p>
@endsection
