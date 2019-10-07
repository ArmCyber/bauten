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
                    <input type="text" name="title" class="form-control" placeholder="Название" maxlength="255" value="{{ old('title', $item->title??null) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @card
            @if(!$edit || $item->static!=$homepage)
                <div class="form-group">
                    <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                    <div class="bottom-input">
                        <input type="text" maxlength="255" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                    </div>
                </div>
            @endif
            @labelauty(['id'=>'on_menu', 'label'=>'Показать в меню', 'checked'=>oldCheck('on_menu', ($edit && empty($item->on_menu))?false:true)])@endlabelauty
            @if (!$edit || $item->static!='catalogs')
                @labelauty(['id'=>'on_footer', 'label'=>'Показать в футер', 'checked'=>oldCheck('on_footer', ($edit && !empty($item->on_footer))?true:false)])@endlabelauty
            @endif
            @if(!$edit || $item->static!=$homepage)
                @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
            @endif
            @endcard
        </div>
    </div>
    @if(!$edit || !$item->static)
        @bannerBlock(['title'=>'Контент'])
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">Баннер (рек. шир. 1440px)</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ asset('u/pages/'.$item->image) }}" class="img-responsive" alt="">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                        @labelauty(['id'=>'show_image', 'class'=>'pt-2', 'label'=>'Показать баннер', 'checked'=>oldCheck('show_image', ($edit && empty($item->show_image))?false:true)])@endlabelauty
                    </div>
                </div>
                <div class="card">
                    <div class="c-title">Alt</div>
                    <div class="little-p">
                        <input type="text" name="image_alt" class="form-control" placeholder="Alt" maxlength="255" value="{{ old('image_alt', $item->image_alt??null) }}">
                    </div>
                </div>
                <div class="card">
                    <div class="c-title">Title</div>
                    <div class="little-p">
                        <input type="text" name="image_title" class="form-control" placeholder="Title" maxlength="255" value="{{ old('image_title', $item->image_title??null) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="col-12">
                    <div class="card">
                        <div class="c-title">Контент</div>
                        <div class="little-p">
                            <textarea name="content" class="form-control form-textarea ckeditor" placeholder="Контент">{!! old('content', $item->content??null) !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endbannerBlock
    @endif
    @seo(['item'=>$item??null])@endseo
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
