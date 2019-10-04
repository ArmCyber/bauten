@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.parts.edit', ['id'=>$item->id]):route('admin.parts.add') !!}" method="post" id="part-form" enctype="multipart/form-data">
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
                    <input type="text" name="name" class="form-control" placeholder="Имя" maxlength="255" value="{{ old('name', $item->name??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Код</div>
                <div class="little-p">
                    <input type="text" name="code" class="form-control" placeholder="Код" maxlength="255" value="{{ old('code', $item->code??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Артикул</div>
                <div class="little-p">
                    <input type="text" name="articule" class="form-control" placeholder="Артикул" maxlength="255" value="{{ old('articule', $item->articule??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">ОЕМ</div>
                <div class="little-p">
                    <input type="text" name="oem" class="form-control" placeholder="ОЕМ" maxlength="255" value="{{ old('oem', $item->oem??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Цена</div>
                <div class="little-p">
                    <input type="text" name="price" class="form-control" placeholder="Цена" maxlength="10" value="{{ old('price', $item->price??null) }}">
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
                <div class="c-title">Изоброжение</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ asset('u/parts/'.$item->image) }}" style="height: 270px; width:auto; max-width: 100%; object-fit: contain" alt="">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                </div>
            </div>
            <div class="card">
                <div class="c-title">Каталог</div>
                <div class="little-p">
                    <select name="part_catalog_id" class="select2" style="width:100%;">
                        @php $selected_part_catalog = old('part_catalog_id', $item->part_catalog_id??null) @endphp
                        @foreach($part_catalogs as $part_catalog)
                            <option value="{{ $part_catalog->id }}" {!! $part_catalog->id==$selected_part_catalog?'selected':null !!}>{{ $part_catalog->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Бренд</div>
                <div class="little-p">
                    @php $selected_brand = old('brand_id', $item->brand_id??null) @endphp
                    <select name="brand_id" class="select2" style="width:100%;">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {!! $brand->id==$selected_brand?'selected':null !!}>{{ $brand->name }} ({{ $brand->code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="c-title">Описание</div>
                <div class="little-p">
                    <textarea name="description" class="form-control form-textarea ckeditor" placeholder="Описание">{!! old('description', $item->description??null) !!}</textarea>
                </div>
            </div>
        </div>
    </div>
    @bannerBlock(['title'=>'Приминяемость'])
        <div id="applicability-rows" class="pb-4"></div>
        <div>
            <button id="add-row" type="button" class="btn btn-success">Добавить</button>
        </div>
    @endbannerBlock
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
<div class="example appl-row row mt-2" style="display: none">
    <div class="col-3">
        <select name="mark_id[]" class="mark_id_select" style="width:100%">
            <option value="0" selected readonly>Выберите марку</option>
        </select>
    </div>
    <div class="col-3">
        <select name="model_id[]" class="model_id_select" style="width:100%" disabled>
            <option value="0">Все</option>
        </select>
    </div>
    <div class="col-3">
        <select name="generation_id[]" class="generation_id_select" style="width:100%" disabled>
            <option value="0">Все</option>
        </select>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-sm btn-danger appl_row_delete">Удалить</button>
    </div>
</div>
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    @ckeditor
    @js(aAdmin('js/applicability.js'))
    <script>
        $('.select2').select2();
        new Applicability({!! $marks->toJson(JSON_UNESCAPED_UNICODE) !!}, {!! session()->has('old_cars')?json_encode(session('old_cars', JSON_UNESCAPED_UNICODE)):(isset($part_cars)?$part_cars->toJson(JSON_UNESCAPED_UNICODE):'false') !!})
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
