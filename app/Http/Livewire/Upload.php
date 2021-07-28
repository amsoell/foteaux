<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public mixed $media = null;
    public ?string $caption = null;

    public function save(): void
    {
        $this->validate([
            'media'   => 'image|required|max:1024',
            'caption' => 'min:2',
        ]);

        auth()->user()?->media()->create([
            'location' => $this->media->storePublicly('media', 's3'),
            'caption'  => $this->caption,
        ]);
    }

    public function render(): View
    {
        return view('livewire.upload');
    }
}
