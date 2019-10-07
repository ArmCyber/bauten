<div class="news-item">
    <div class="news-img">
        <a href="{{ $url = route('news', ['url'=>$item->url]) }}" class="force-16-9"><img src="{{ asset('u/news/'.$item->image) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}"></a>
        <span class="news-date">
                                <span class="news-day">{{ $item->created_at->day }}</span>
                                <span class="news-month">{{ __('months.lonely.'.$item->created_at->month) }}</span>
                                <span class="news-year">{{ $item->created_at->year }}</span>
                            </span>
    </div>
    <div class="news-content">
        <div class="news-title"><a href="{{ $url }}">{{ $item->title }}</a></div>
        <div class="news-short">{{ $item->short }}</div>
    </div>
</div>
