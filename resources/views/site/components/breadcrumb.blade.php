<div class="breadcrumb page-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('page') }}">{{ $homepage->title }}</a></div>
    @foreach($pages??[] as $page)
        <div class="breadcrumb-item">
            @isset($page['url'])
                <a href="{{ $page['url']?$page['url']:'javascript:void(0)' }}">{{ $page['title']??null }}</a>
            @else
                {{ $page['title']??null }}
            @endisset
        </div>
    @endforeach
</div>
