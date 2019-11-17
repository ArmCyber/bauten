@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.generations.edit', ['id'=>$item->id]):route('admin.generations.add', ['id'=>$model->id]) !!}" method="post">
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
                <div class="c-title">ID</div>
                <div class="little-p">
                    <input type="text" name="cid" class="form-control" maxlength="255" placeholder="ID" value="{{ old('cid', $item->cid??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Имя</div>
                <div class="little-p">
                    <input type="text" name="name" class="form-control" placeholder="Имя" maxlength="255" value="{{ old('name', $item->name??null) }}">
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
            <div class="card d-none">
                <div class="c-title">Объем двигателя, см3</div>
                <div class="little-p">
                    <input type="text" name="engine" class="form-control" maxlength="10" placeholder="Объем двигателя, см3" value="{{ old('engine', $item->engine??null) }}">
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
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
