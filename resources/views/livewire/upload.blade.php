<div>
    <h1>Upload a new photo</h1>
    <form wire:submit.prevent="save">
        <div>
            <x-jet-label for="media" value="{{ __('Photo') }}" />
            <x-jet-input id="media" class="block mt-1 w-full" type="file" name="media" wire:model="media" />
            <x-jet-input-error for="media" class="mt-2" />
        </div>
        <div>
            <x-jet-label for="caption" value="{{ __('caption') }}" />
            <x-jet-input id="caption" class="block mt-1 w-full" type="text" name="caption" wire:model="caption" />
            <x-jet-input-error for="caption" class="mt-2" />
        </div>


        <button type="submit">Add photo</button>
    </form>
</div>
