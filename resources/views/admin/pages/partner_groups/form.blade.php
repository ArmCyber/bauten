@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.partner_groups.edit', ['id'=>$item->id]):route('admin.partner_groups.add') !!}" method="post">
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
            @can('admin')
            @if(!$edit || $item->id!=1)
                <div class="card">
                    <div class="c-title">Скидка (%)</div>
                    <div class="little-p">
                        <input type="text" name="sale" class="form-control" placeholder="Скидка (%)" maxlength="3" value="{{ old('sale', $item->sale??null) }}">
                    </div>
                </div>
            @endif
            @endcan
        </div>
        <div class="col-12 col-lg-6">
            @if(!$edit || $item->id!=1)
            <div class="card">
                <div class="c-title">Условия перехода на уровень</div>
                <div class="little-p">
                    <textarea name="terms" class="ckeditor">{!! old('terms', $item->terms??null) !!}</textarea>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
