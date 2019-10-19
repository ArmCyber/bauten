@extends('admin.layouts.app')
@section('content')
<form action="{!! url()->current() !!}" method="post" enctype="multipart/form-data">@csrf
    @if ($response)
        @if($response=='failed')
            <div class="alert alert-danger" role="alert">Импортирование не произашло. Причина: неправильный формат файла.</div>
        @else
            <div class="alert alert-success" role="alert">Импортирование произашло.</div>
            @php $multiple_sheets = count($response)>1 @endphp
            @foreach($response as $sheet)
                @if($sheet['status'])
                    <div class="alert alert-info mb-1" role="alert">{{ $multiple_sheets?'Лист '.$loop->iteration.': ':null }}Успешные элементы - {{ $sheet['imported'] }}, Неуспешные елементы - {{ $sheet['failed'] }}.</div>
                    @if($sheet['failed']>0)
                        <div class="alert alert-danger" role="alert">
                            <p>Ошыбки.</p>
                            @foreach($sheet['errors'] as $error)
                                <p>Линия {{ $error['row'] }}. {{ $error['reason'] }}</p>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="alert alert-danger" role="alert">Импортирование не произашло. Причина: неправильный формат листа.</div>
                @endif
            @endforeach
        @endif
    @endif
    <div class="row mt-3">
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
