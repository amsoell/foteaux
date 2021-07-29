<div class="m-6">
    <form wire:submit.prevent="save">
        <div class="border-dashed border-2 border-light-blue-500 p-6">
            @if ($media)
                <img src="{{ $media->temporaryUrl() }}">
            @endif
            @error('media') <span class="error">{{ $message }}</span> @enderror
            <x-jet-input id="media" class="block mt-1 w-full" type="file" name="media" wire:model="media" />
        </div>
        <div class="pt-6">
            <textarea id="caption" class="block w-full border-solid border-2 border-light-blue-500 p-6" type="text" name="caption" placeholder="Caption" wire:model="caption"></textarea>
            <x-jet-input-error for="caption" class="mt-2" />
        </div>


        <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition mt-2 mr-2">Add photo</button>
    </form>
</div>
