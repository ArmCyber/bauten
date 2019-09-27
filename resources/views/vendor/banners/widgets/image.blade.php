<div class="form-group">
    <div class="bylang-header">
        <div class="bylang-title has-title">
            {{ $label??null }}
            @if (!empty($settings['resize'][1]) && !empty($settings['resize'][2]) && (!isset($settings['hint']) || !empty($settings['hint'])))
             ({!! $settings['resize'][1].'x'.$settings['resize'][2] !!})
            @endif
        </div>
    </div>
    <div class="little-p">
        @if (!empty($value))
            <div class="py-2 text-{{ $settings['preview_position']??'center' }}">
                <img src="{{ asset('u/banners/'.$value) }}" alt="" class="{{ $settings['preview_classes']??null }}" style="max-width:80%;width:auto;height:auto;">
            </div>
        @endif
        <div class="c-body">
            @file(['name'=>$name])@endfile
        </div>
    </div>
</div>