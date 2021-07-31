<?php

namespace App\Actions;

use App\Models\User;

class Unfollow
{
    public function __invoke(User $user): void
    {
        auth()->user()?->following()->detach($user);
    }
}
