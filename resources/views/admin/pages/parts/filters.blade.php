@extends('admin.layouts.app')
@section('content')
<form action="{{ url()->current() }}" method="post" id="part-form" enctype="multipart/form-data">
    @csrf @method('patch')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div>
        <div class="pb-2">
            <select class="filters-select2" style="width:400px; max-width: 100%" multiple>
                @foreach($filters as $filter)
                    <option value="{{ $filter->id }}">{{ $filter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="filter-blocks" class="row row-grid pt-2"></div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
<div class="filter-block-example col-12 col-sm-6 col-xl-4" style="display:none">
    <div class="card little-p">
        <div class="filter-title" style="font-size:16px;"></div>
        <div class="filter-select">
            <select name="criteria[]" class="criteria-select" multiple style="width:100%"></select>
        </div>
    </div>
</div>
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        window.itemFilters = {!! $selected_filters->toJson() !!};
        window.filters = {!! $filters->mapWithKeys(function($item){
            return [$item->id => $item];
        })->toJson(JSON_UNESCAPED_UNICODE) !!};
    </script>
    @js(aAdmin('js/part_filters.js'))
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
