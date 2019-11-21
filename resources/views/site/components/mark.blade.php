<a href="{{ route('search', ['ma'=>$item->id]) }}" class="part-item">
    <span class="part-img"><img src="{{ ($item->image && $item->show_image)?asset('u/marks/'.$item->image):$default_images->data->marks() }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}"></span>
    <span class="part-title">{{ $item->name }}</span>
</a>
