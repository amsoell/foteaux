<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Feed extends Component
{
    public mixed $media;
    public User | null $user;

    public function render(): View
    {
        return view('livewire.feed');
    }

    public function mount(mixed $media, User $user = null): void
    {
        $this->media = $media;
        $this->user = $user;
    }
}
