@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.marks.edit', ['id'=>$item->id]):route('admin.marks.add') !!}" method="post" enctype="multipart/form-data">
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
                <div class="c-title">Имя</div>
                <div class="little-p">
                    <input type="text" name="name" class="form-control" maxlength="255" placeholder="Имя" value="{{ old('name', $item->name??null) }}">
                </div>
            </div>
            <div class="card px-3 py-2 d-none">
                <div class="row cstm-input">
                    <div class="col-12 p-b-5">
                        <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                        <div class="bottom-input">
                            <input type="text" maxlength="255" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Статус</div>
                <div class="little-p">
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
            <div class="card">
                <div class="c-title">Показать в главном ст.</div>
                <div class="little-p">
                    @labelauty(['id'=>'in_home', 'label'=>'Не показано|Показано', 'checked'=>oldCheck('in_home', ($edit && empty($item->in_home))?false:true)])@endlabelauty
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Логотип ((<=200)x56)</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ asset('u/marks/'.$item->image) }}" alt="" class="img-responsive">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                    <div class="pt-2">
                        <input type="text" name="image_alt" class="form-control" maxlength="255" placeholder="Alt" value="{{ old('image_alt', $item->image_alt??null) }}">
                    </div>
                    <div class="pt-2">
                        <input type="text" name="image_title" class="form-control" maxlength="255" placeholder="Title" value="{{ old('image_title', $item->image_title??null) }}">
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
