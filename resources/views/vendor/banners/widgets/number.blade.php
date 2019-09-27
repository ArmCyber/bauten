<div class="form-group">
    <div class="bylang-header">
        <div class="bylang-title has-title">{{ $label??null }}</div>
    </div>
    <div class="little-p">
        <input type="number" {!! isset($settings['min'])?'min="'.e($settings['min']).'"':null !!} {!! isset($settings['max'])?'max="'.e($settings['max']).'"':null !!} name="{!! $name !!}" class="form-control" placeholder="{{ $label??null }}" value="{{ $value }}">
    </div>
</div>