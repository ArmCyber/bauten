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
                <div class="c-title">Название</div>
                <div class="little-p">
                    <input type="text" name="name" class="form-control" placeholder="Название" maxlength="255" value="{{ old('name', $item->name??null) }}">
                </div>
            </div>
            @can('admin')
            <div class="card">
                <div class="c-title">REF</div>
                <div class="little-p">
                    <input type="text" name="ref" class="form-control" placeholder="REF" maxlength="255" value="{{ old('ref', $item->ref??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Артикул</div>
                <div class="little-p">
                    <input type="text" name="code" class="form-control" placeholder="Артикул" maxlength="255" value="{{ old('code', $item->code??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">ОЕМ</div>
                <div class="little-p">
                    <input type="text" name="oem" class="form-control" placeholder="ОЕМ" maxlength="255" value="{{ old('oem', $item->oem??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Цена до скидки</div>
                <div class="little-p">
                    <input type="text" name="sale" class="form-control" placeholder="Цена до скидки" maxlength="10" value="{{ old('sale', $item->sale??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Цена</div>
                <div class="little-p">
                    <input type="text" name="price" class="form-control" placeholder="Цена" maxlength="10" value="{{ old('price', $item->price??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Скидка за количество</div>
                <div class="little-p">
                    <input type="text" name="count_sale_count" class="form-control" placeholder="Количество" maxlength="4" value="{{ old('count_sale_count', $item->count_sale_count??null) }}">
                    <input type="text" name="count_sale_percent" class="form-control mt-1" placeholder="Процент скидки" maxlength="3" value="{{ old('count_sale_percent', $item->count_sale_percent??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Остаток</div>
                <div class="little-p">
                    <input type="text" name="available" class="form-control" placeholder="Остаток" maxlength="10" value="{{ old('available', $item->available??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Мин. количество заказа</div>
                <div class="little-p">
                    <input type="text" name="min_count" class="form-control" placeholder="Мин. количество заказа" maxlength="10" value="{{ old('min_count', $item->min_count??1) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Кол. в пакете</div>
                <div class="little-p">
                    <input type="text" name="multiplication" class="form-control" placeholder="Кол. в пакете" maxlength="10" value="{{ old('multiplication', $item->multiplication??1) }}">
                </div>
            </div>
            @endcan
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Изоброжение (рек. выс. 270px)</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ asset('u/parts/'.$item->image) }}" style="height: 270px; width:auto; max-width: 100%; object-fit: contain" alt="">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                    @labelauty(['id'=>'show_image', 'class'=>'mt-3', 'label'=>'Показать изоброжение', 'checked'=>oldCheck('show_image', ($edit && empty($item->show_image))?false:true)])@endlabelauty
                </div>
            </div>
            @can('admin')
            <div class="card">
                <div class="c-title">Категория</div>
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
            <div class="card">
                <div class="c-title">Двигатели</div>
                <div class="little-p">
                    <select name="engine_id[]" class="select2" style="width:100%;" multiple>
                        @foreach($engines as $engine)
                            <option value="{{ $engine->id }}" {!! (isset($item) && $item->engines->where('id', $engine->id)->first())?'selected':null !!}>{{ $engine->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endcan
            <div class="card px-3 py-2">
                <div class="row cstm-input">
                    <div class="col-12 p-b-5">
                        <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                        <div class="bottom-input">
                            <input type="text" maxlength="255" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                        </div>
                    </div>
                </div>
                @labelauty(['id'=>'new', 'class'=>'mt-2', 'label'=>'Новинка', 'checked'=>oldCheck('new', ($edit && empty($item->new))?false:true)])@endlabelauty
                @can('admin')
                @labelauty(['id'=>'application_only', 'class'=>'mt-1', 'label'=>'Под заказ', 'checked'=>oldCheck('application_only', ($edit && $item->application_only)?true:false)])@endlabelauty
                @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                @endcan
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
    @can('admin')
    @bannerBlock(['title'=>'Применяемость по автомобилям'])
    <div id="applicability-rows" class="pb-4"></div>
    <div>
        <button id="add-row" type="button" class="btn btn-success">Добавить</button>
    </div>
    @endbannerBlock
    @endcan
    {{--
    @bannerBlock(['title'=>'Применяемость по двигателям'])
    <div id="engine-rows" class="pb-4"></div>
    <div>
        <button id="add-engine-row" type="button" class="btn btn-success">Добавить</button>
    </div>
    @endbannerBlock
    --}}
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@can('admin')
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
@endcan
{{--<div class="example engine-row row mt-2" style="display: none">
    <div class="col-3">
        <select name="engine_mark_id[]" class="mark_id_select" style="width:100%">
            <option value="0" selected readonly>Выберите марку</option>
        </select>
    </div>
    <div class="col-3">
        <select name="engine_id[]" class="engine_id_select" style="width:100%" disabled></select>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-sm btn-danger engine_row_delete">Удалить</button>
    </div>
</div>--}}
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    @ckeditor
    @can('admin')
    @js(aAdmin('js/applicability.js'))
{{--    @js(aAdmin('js/engine_applicability.js'))--}}
    <script>
        $('.select2').select2();
        new Applicability({!! $marks->toJson(JSON_UNESCAPED_UNICODE) !!}, {!! session()->has('old_cars')?json_encode(session('old_cars', JSON_UNESCAPED_UNICODE)):(isset($part_cars)?$part_cars->toJson(JSON_UNESCAPED_UNICODE):'false') !!})
{{--        new EngineApplicability({!! $engine_marks->toJson(JSON_UNESCAPED_UNICODE) !!}, {!! session()->has('old_engines')?json_encode(session('old_engines', JSON_UNESCAPED_UNICODE)):(isset($part_engines)?$part_engines->toJson(JSON_UNESCAPED_UNICODE):'false') !!})--}}
    </script>
    @endcan
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
