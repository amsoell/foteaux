<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MediaItem extends Component
{
    public Media $item;

    public function render(): View
    {
        return view('livewire.media-item');
    }

    public function mount(Media $item): void
    {
        $this->item = $item;
    }
}
