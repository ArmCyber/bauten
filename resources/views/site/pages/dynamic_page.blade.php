@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div>
        @if($page->show_image && $page->image)
            <div class="about-page-banner pt-s">
                <img src="{{ asset('u/pages/'.$page->image) }}" alt="{{ $page->image_alt }}" title="{{ $page->image_title }}" class="img-fluid">
            </div>
        @endif
        <div class="about-page-content dynamic-text pt-s">{!! $page->content !!}</div>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
