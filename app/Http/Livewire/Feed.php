<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Feed extends Component
{
    public function render(): View
    {
        return view('livewire.feed');
    }

    public function mount($media)
    {
        $this->media = $media;
    }
}
