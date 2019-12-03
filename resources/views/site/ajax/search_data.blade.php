@foreach($items as $key=>$elems)
    <div class="col-2">
        <div class="search-group">
            <div class="search-group-title">{{ $key }}</div>
            <div class="search-group-items">
                @foreach($elems as $elem)
                    <div class="search-group-item"><span class="search-group-select {{ $class }}" data-type="model" data-id="{{ $elem['id'] }}">{{ $elem['name'] }}</span></div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
