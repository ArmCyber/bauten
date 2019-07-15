@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.pages.edit', ['id'=>$item->id]):route('admin.pages.add') !!}" method="post" enctype="multipart/form-data">
    @csrf @method($edit?'patch':'put')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{--@if($edit)--}}
        {{--<div class="py-2 h5">Ссылка: {{ $item->static==$homepage?'/':route('page', ['url'=>$item['url']], false) }}</div>--}}
    {{--@endif--}}
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Название</div>
                <div class="little-p">
                    <input type="text" name="title" class="form-control" placeholder="Название" value="{{ old('title', $item->title??null) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @card
            @if(!$edit || $item->static!=$homepage)
                <div class="form-group">
                    <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                    <div class="bottom-input">
                        <input type="text" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                    </div>
                </div>
            @endif
            @labelauty(['id'=>'on_menu', 'label'=>'Показать в меню', 'checked'=>oldCheck('on_menu', ($edit && empty($item->on_menu))?false:true)])@endlabelauty
            @if(!$edit || $item->static!=$homepage)
                @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
            @endif
            @endcard
        </div>
    </div>
    @seo(['item'=>$item??null])@endseo
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush