@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.years.edit', ['id'=>$item->id]):route('admin.years.add') !!}" method="post">
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
                <div class="c-title">Год</div>
                <div class="little-p">
                    <input type="text" name="year" class="form-control" placeholder="Год" maxlength="5" value="{{ old('year', $item->year??null) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
