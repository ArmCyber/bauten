@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.parts.edit', ['id'=>$item->id]):route('admin.parts.add') !!}" method="post">
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
                <div class="c-title">Статус</div>
                <div class="little-p">
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Каталог</div>
                <div class="little-p">
                    <select name="part_catalog_id" class="select2" style="width:100%;">
                        @foreach($part_catalogs as $part_catalog)
                            <option value="{{ $part_catalog->id }}">{{ $part_catalog->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Бренд</div>
                <div class="little-p">
                    <select name="brand_id" class="select2" style="width:100%;">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }} ({{ $brand->code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $('.select2').select2();
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
