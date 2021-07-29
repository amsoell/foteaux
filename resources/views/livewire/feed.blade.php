<div>
    @foreach ($media as $item)
    <livewire:media-item :item="$item" />
    @endforeach

    <div class="px-6 pb-6">{{ $media->links() }}</div>
</div>
