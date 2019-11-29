@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.modifications.edit', ['id'=>$item->id]):route('admin.modifications.add') !!}" method="post">
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
                <div class="c-title">Авто</div>
                <div class="little-p">
                    @php
                        $selectedMark = old('mark_id', $item->mark->id??0);
                        $selectedModel = old('model_id', $item->model->id??0);
                        $selectedGeneration = old('generation_id', $item->generation->id??null);
                        $thisMark = $marks->where('id', $selectedMark)->first();
                        if (!$thisMark) $thisMark = $marks[0];
                        $thisModels = $thisMark->models;
                        $thisModel = $thisModels->where('id', $selectedModel)->first();
                        if (!$thisModel) $thisModel = $thisMark->models[0];
                        $thisGenerations = $thisModel->generations;
                    @endphp
                    <div>
                        <div>Марка</div>
                        <select class="select2" name="mark_id" id="mark-select" style="width: 100%">
                            @foreach($marks as $mark)
                                <option value="{{ $mark->id }}" @if($mark->id == $selectedMark) selected @endif >{{ $mark->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <div>Модель</div>
                        <select class="select2" name="model_id" id="model-select" style="width: 100%">
                            @foreach($thisModels as $model)
                                <option value="{{ $model->id }}" @if($model->id == $selectedModel) selected @endif>{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <div>Кузов</div>
                        <select class="select2" name="generation_id" id="generation-select" style="width: 100%">
                            @foreach($thisGenerations as $generation)
                                <option value="{{ $generation->id }}" @if($generation->id == $selectedGeneration) selected @endif>{{ $generation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $('.select2').select2();
        var marks = {!! $marks->toJson(JSON_UNESCAPED_UNICODE) !!},
            markSelect = $('#mark-select'),
            modelSelect = $('#model-select'),
            generationSelect = $('#generation-select');
        markSelect.on('change', function(){
            var thisModels = marks.find(x => x.id==$(this).val()).models;
            modelSelect.html('');
            $.each(thisModels, function(i,e){
                $('<option></option>').attr('value', e.id).text(e.name).appendTo(modelSelect);
            });
            modelSelect.trigger('change');
        });
        modelSelect.on('change', function(){
           var thisGens = marks.find(x => x.id==markSelect.val()).models.find(x => x.id==$(this).val()).generations;
            generationSelect.html('');
            $.each(thisGens, function(i,e){
                $('<option></option>').attr('value', e.id).text(e.name).appendTo(generationSelect);
            });
            generationSelect.trigger('change');
        });
    </script>
@endpush
