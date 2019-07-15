<div class="form-group">
    @if(!empty($title))
        <div class="col-form-label d-inline-block align-middle" style="font-weight:600">{!! $title !!}</div>
    @endif
    <div class="d-inline-block @if(!empty($title)) p-l-5 @endif align-middle">
        <select name="{{ $name??null }}" class="z-select" {!! exists('id="',$id,'"') !!}>
            @foreach ($options as $option)
                <option value="{!! $option['value']??null !!}" data-class="{{ $option['class']??null }}"{!! empty($option['checked'])?null:' checked' !!}>{{ $option['label']??null }}</option>
            @endforeach
        </select>
    </div>
</div>