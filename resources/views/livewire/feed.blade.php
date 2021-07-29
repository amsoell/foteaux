<div>
    @foreach ($media as $item)
    <livewire:media-item :item="$item" />
    @endforeach

    {{ $media->links() }}
</div>
