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
        ]);
    }

    public function show(User $user): View
    {
        $media = $user->media;

        return view('feed', compact('media'));
    }
}
