@extends('admin.layouts.app')
@section('content')
<form action="{!! route('admin.marks.import') !!}" method="post" enctype="multipart/form-data">@csrf
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
                <div class="c-title">Файл Excel</div>
                <div class="c-body">
                    @file(['name'=>'file', 'title'=>'Выберите файл...'])@endfile
                    <div class="pt-2 text-right">
                        <button type="submit" class="btn btn-success">Импортировать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
