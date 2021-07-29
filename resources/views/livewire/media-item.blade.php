<div class="flex flex-wrap media-item pb-6">
    <img class="md:w-1/2 w-full flex-none" src="{{ $item->url }}" />
    <div class="md:flex-1 w-full p-6">
        <div class="meta pb-3">
            <strong>{{ $item->user->name}}</strong>
            <span class="text-xs ml-3">{{ $item->created_at->diffForHumans() }}</span>
        </div>
        <caption>
            {{ $item->caption }}
        </caption>
    </div>
</div>