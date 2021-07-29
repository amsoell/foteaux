<div class="p-6 text-center">
    @forelse ($media as $item)
    <livewire:media-item :item="$item" />
    <div class="px-6 pb-6">{{ $media->links() }}</div>
    @empty
    Your feed is empty
    @endforelse

</div>
