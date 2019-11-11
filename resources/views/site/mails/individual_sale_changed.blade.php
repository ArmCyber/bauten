@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.individual_sale_changed.message', ['sale'=>$individual_sale]) }}</p>
@endsection
