@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    <h1 class="page-title">{{ $item->name }}</h1>
    <div>
        <div class="text-center pt-s">
            <img src="{{ asset('u/brands/'.$item->image) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}" class="img-fluid">
        </div>
        <div class="about-page-content dynamic-text pt-s">{!! $item->description !!}</div>
    </div>
</div>
@endsection
