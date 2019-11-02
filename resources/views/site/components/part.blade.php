<div class="product-item">
    <div class="product-favourite product-card-favourite{!! in_array($item->id, $favourite_ids)?' saved':null !!}" data-id="{{ $item->id }}" title="Сохранить"></div>
    <div class="product-image"><a href="{{ $item_url = route('part', ['url'=>$item->url]) }}">
            <img src="{{ ($item->image && $item->show_image)?asset('u/parts/'.$item->image):$default_images->data->parts() }}" alt="{{ $item->name }}">
        </a></div>
    <div class="product-title"><a href="{{ $item_url }}">{{ $item->name }}</a></div>
    <div class="product-price"><span class="catalogue-price">Цена: <span class="cat-price">{{ $item->price }}</span> <span class="kzt"></span></span></div>
</div>
