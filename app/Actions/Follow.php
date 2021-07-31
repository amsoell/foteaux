<?php

namespace App\Actions;

use App\Models\User;

class Follow
{
    public function __invoke(User $user): void
    {
        auth()->user()?->following()->attach($user);
    }
}
