@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.engines.edit', ['id'=>$item->id]):route('admin.engines.add') !!}" method="post">
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
                <div class="c-title">Номер</div>
                <div class="little-p">
                    <input type="text" name="number" class="form-control" placeholder="Номер" maxlength="255" value="{{ old('number', $item->number??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Название</div>
                <div class="little-p">
                    <input type="text" name="name" class="form-control" placeholder="Имя" maxlength="255" value="{{ old('name', $item->name??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Период продаж</div>
                <div class="little-p">
                    <input type="text" name="year" class="form-control" maxlength="4" placeholder="От" value="{{ old('year', $item->year??null) }}">
                    <input type="text" name="year_to" class="form-control mt-1" maxlength="4" placeholder="До" value="{{ old('year_to', $item->year_to??null) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Марки</div>
                <div class="little-p">
                    <select name="mark_id[]" class="select2" style="width: 100%" multiple>
                        @foreach($marks as $mark)
                            @php
                                $selected=(isset($item) && $item->marks->where('id', $mark->id)->first())?'selected':null;
                            @endphp
                            <option value="{{ $mark->id }}" {!! $selected !!}>{{ $mark->name }}</option>
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
