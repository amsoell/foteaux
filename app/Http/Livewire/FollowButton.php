<?php

namespace App\Http\Livewire;

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
        auth()->user()?->following()->attach($this->user);
    }

    public function unfollow(): void
    {
        auth()->user()?->following()->detach($this->user);
    }
}
