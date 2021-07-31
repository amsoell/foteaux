<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public mixed $media = null;
    public ?string $caption = null;

    public function save(): Redirector | RedirectResponse
    {
        $this->validate([
            'media'   => 'image|required|max:1024',
            'caption' => 'min:2',
        ]);

        auth()->user()?->media()->create([
            'location' => $this->media->storePublicly('media', 's3'),
            'caption'  => $this->caption,
        ]);

        session()->flash('message', 'Your photo has been added to your feed');

        return redirect()->route('profile', [
            'user' => auth()->user(),
        ]);
    }

    public function render(): View
    {
        return view('livewire.upload');
    }
}
