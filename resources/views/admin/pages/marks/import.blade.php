@extends('admin.layouts.app')
@section('content')
<form action="{!! route('admin.marks.import') !!}" method="post" enctype="multipart/form-data">@csrf
    @if ($response)
        @if($response['status'])
            <div class="alert alert-success" role="alert">Импортирование произашло.</div>
            <div class="alert alert-info" role="alert">Успешные элементы - {{ $response['imported'] }}, Неуспешные елементы - {{ $response['failed'] }}.</div>
            @if($response['failed']>0)
                <div class="alert alert-danger" role="alert">
                    <p>Ошыбки.</p>
                    @foreach($response['errors'] as $error)
                        <p>Линия {{ $error['row'] }}. {{ $error['reason'] }}</p>
                    @endforeach
                </div>
            @endif
        @else
            <div class="alert alert-danger" role="alert">Импортирование не произашло. Причина: неправильный формат.</div>
        @endif
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
