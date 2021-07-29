<div>
    @foreach ($media as $item)
    <div class="media-item">
        <img src="{{ $item->url }}" />
        <caption>{{ $item->caption }}</caption>
    </div>
    @endforeach

    {{ $media->links() }}
</div>
