<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Feed extends Component
{
    private mixed $media;
    public User | null $user;

    public function render(): View
    {
        return view('livewire.feed', [
            'media' => $this->media->paginate(2),
        ]);
    }

    public function mount(mixed $media, User $user = null): void
    {
        $this->media = $media;
        $this->user = $user;
    }
}
