@extends('admin.layouts.app')
@section('content')
<form id="form" action="{!! url()->current() !!}" method="post" enctype="multipart/form-data">@csrf
    <div>Требуемые столбцы:
        @foreach($columns as $column)
            '<b>{{ $column }}</b>',
        @endforeach
    </div>
    @if ($response)
        @if($response=='unvalidated')
            <div class="alert alert-danger" role="alert">Выберите Excel файл.</div>
        @elseif($response=='failed')
            <div class="alert alert-danger" role="alert">Импортирование не произашло. Причина: неправильный формат файла.</div>
        @else
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
                        <button type="submit" id="form-submit" class="btn btn-success">Импортировать</button>
                    </div>
                </div>
            </div>
            <div id="show-on-submit" class="font-weight-bold font-16" style="display: none">
                <div class="text-danger">Подождите, идет импортирование...</div>
                <div id="stopwatch">00:00</div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
    <script>
        $('#form').on('submit', function(e){
            $('#show-on-submit').show();
            $('#form-submit').attr('disabled', 'disabled');
            var stopwatch = $('#stopwatch'),
                seconds = 0,
                minutes = 0;
            setInterval(function(){
                if (seconds>=59) {
                    seconds = 0;
                    ++minutes;
                } else ++seconds;
                var thisSeconds = seconds>9?seconds:'0'+seconds.toString(),
                    thisMinutes = minutes>9?minutes:'0'+minutes.toString();
                stopwatch.html(thisMinutes+':'+thisSeconds);
            }, 1000);
        });
    </script>
@endpush
