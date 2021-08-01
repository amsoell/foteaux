<?php

namespace App\Http\Livewire;

use App\Actions\Follow;
use App\Actions\Unfollow;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FollowButton extends Component
{
    public User $user;

    public function render(): View
    {
        return view('livewire.follow-button');
    }

    public function follow(): void
    {
        (new Follow())($this->user);
    }

    public function unfollow(): void
    {
        (new Unfollow())($this->user);
    }
}
