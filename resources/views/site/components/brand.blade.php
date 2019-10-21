<a href="{{ route('brand', ['url'=>$item->url]) }}" class="brand-item">
    <span class="brand-img"><img src="{{ asset('u/brands/'.$item->image) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}"></span>
    <span class="brand-title">{{ $item->name }}</span>
</a>
