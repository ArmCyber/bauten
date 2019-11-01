@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.delivery_points.edit', ['id'=>$item->id]):route('admin.delivery_points.add') !!}" method="post">
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
            <div class="card">
                <div class="c-title">Стоимность доставки</div>
                <div class="little-p">
                    <input type="text" name="title" class="form-control" placeholder="Стоимность доставки" maxlength="255" value="{{ old('price', $item->price??null) }}">
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
            <div class="card">
                <div class="c-title">Страна</div>
                <div class="little-p">
                    <select class="select2" name="country_id" id="country-select" style="width:100%">
                        @php
                            $selectedCountry = old('country_id', $item->region->country->id??0);
                        @endphp
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if($selectedCountry == $country->id) selected @endif>{{ $country->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Регион</div>
                <div class="little-p">
                    <select class="select2" name="region_id" id="region-select" style="width:100%">
                        @php
                            $selectedRegion = old('region_id', $item->region->id??0);
                            if ($selectedCountry) $loop_regions = $countries->where('id', $selectedCountry)->first()->regions??null;
                            if (!$selectedCountry || !$loop_regions) $loop_regions = $countries[0]->regions??[];
                        @endphp
                        @foreach($loop_regions as $region)
                            <option value="{{ $region->id }}" @if($selectedRegion == $region->id) selected @endif>{{ $region->title }}</option>
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
        var countries = {!! $countries->toJson(JSON_UNESCAPED_UNICODE) !!}
        $('.select2').select2();
        var regionSelect = $('#region-select');
        $('#country-select').on('change', function(){
            var regions = countries.find(x => x.id===parseInt($(this).val())).regions;
            regionSelect.html('');
            $.each(regions, function(e, region){
                $('<option></option>').attr('value', region.id).text(region.title).appendTo(regionSelect);
            });
        });
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
