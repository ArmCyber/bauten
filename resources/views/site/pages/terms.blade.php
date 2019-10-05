@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
</div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
