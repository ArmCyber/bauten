@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.reset.message') }}</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
@endsection
