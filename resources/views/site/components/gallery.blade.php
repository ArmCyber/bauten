@if(count($gallery))
    <div class="page-gallery pt-2s">
        <div class="row row-grid">
            @foreach($gallery as $image)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ asset('u/gallery/'.$image->image) }}" data-fancybox="gallery" class="force-4-3" title="{{ $image->title }}">
                        <img src="{{ asset('u/gallery/thumbs/'.$image->image) }}" alt="{{ $image->alt }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @if(empty($skip_plugin))
        @push('js')
            @js(aApp('fancybox/fancybox.js'))
        @endpush
        @push('css')
            @css(aApp('fancybox/fancybox.css'))
        @endpush
    @endif
@endif
