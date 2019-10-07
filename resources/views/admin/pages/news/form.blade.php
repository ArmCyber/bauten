@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.news.edit', ['id'=>$item->id]):route('admin.news.add') !!}" method="post" enctype="multipart/form-data">
    @csrf @method($edit?'patch':'put')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Название</div>
                <div class="little-p">
                    <input type="text" name="title" class="form-control" placeholder="Название" maxlength="255" value="{{ old('title', $item->title??null) }}">
                </div>
            </div>
            <div class="card px-3 py-2">
                <div class="row cstm-input">
                    <div class="col-12 p-b-5">
                        <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                        <div class="bottom-input">
                            <input type="text" maxlength="255" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                        </div>
                    </div>
                </div>
                @labelauty(['id'=>'active', 'class'=>'mt-3', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Изоброжение 16:9 (480x270)</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ asset('u/news/'.$item->image) }}" style="height: 270px; width:auto; max-width: 100%; object-fit: contain" alt="">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
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
        <div class="col-12">
            <div class="card">
                <div class="c-title">Короткое описание</div>
                <div class="little-p">
                    <textarea name="short" class="form-control form-textarea" placeholder="Короткое описание">{{ old('short', $item->short??null) }}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Контент</div>
                <div class="little-p">
                    <textarea name="content" class="form-control form-textarea ckeditor" placeholder="Контент">{!! old('content', $item->content??null) !!}</textarea>
                </div>
            </div>
        </div>
    </div>
    @seo(['item'=>$item??null])@endseo
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
