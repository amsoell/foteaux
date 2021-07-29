<div>
    @if (auth()->user()->following->contains($user))
    <button wire:click="unfollow">Unfollow</button>
    @else
    <button wire:click="follow">Follow</button>
    @endif
</div>
