<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Feed extends Component
{
    public function render(): View
    {
        $this->media = auth()->user()->media()->take(2)->get();

        return view('livewire.feed');
    }
}
