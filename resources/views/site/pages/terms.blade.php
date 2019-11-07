@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div class="term-blocks">
        @foreach($items as $item)
            <div class="term-block">
                <div class="term-block-title">{{ $item->title }}</div>
                <div class="term-block-content">{!! $item->description !!}</div>
            </div>
        @endforeach
    </div>
    @component('site.components.gallery', ['gallery' => $gallery])@endcomponent
</div>
@endsection
