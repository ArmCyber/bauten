@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.home_slider.edit', ['id'=>$item->id]):route('admin.home_slider.add') !!}" method="post" enctype="multipart/form-data">
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
            <div class="card">
                <div class="c-title">Описание</div>
                <div class="little-p">
                    <textarea name="description" class="form-textarea form-control" placeholder="Описание" maxlength="1000">{{ old('description', $item->description??null) }}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Статус</div>
                <div class="little-p">
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Изоброжение</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ asset('u/home_slider/'.$item->image) }}" alt="" class="img-responsive">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                    <div class="pt-2">
                        <input type="text" name="image_alt" class="form-control" placeholder="Alt" maxlength="255" value="{{ old('image_alt', $item->image_alt??null) }}">
                    </div>
                    <div class="pt-2">
                        <input type="text" name="image_title" class="form-control" placeholder="Title" maxlength="255" value="{{ old('image_title', $item->image_title??null) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
{{--@push('js')--}}
    {{--@js(aApp('select2/select2.js'))--}}
    {{--<script>--}}
        {{--$('.select2').select2();--}}
    {{--</script>--}}
{{--@endpush--}}
{{--@push('css')--}}
    {{--@css(aApp('select2/select2.css'))--}}
{{--@endpush--}}