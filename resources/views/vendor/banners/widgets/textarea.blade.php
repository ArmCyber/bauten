<div class="form-group">
    <div class="bylang-header">
        <div class="bylang-title has-title">{{ $label??null }}</div>
    </div>
    <div class="little-p">
        <textarea name="{!! $name !!}" class="form-textarea form-control" placeholder="{{ $label??null }}">{{ $value }}</textarea>
    </div>
</div>