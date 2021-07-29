<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        return view('feed', [
            'media' => auth()->user()->feed_media ?? [],
            'title' => 'My Feed',
        ]);
    }

    public function show(User $user): View
    {
        return view('feed', [
            'media' => $user->media()->orderBy('created_at', 'DESC'),
            'title' => $user->name,
            'user' => $user,
        ]);
    }
}
