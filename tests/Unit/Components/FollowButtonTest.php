<?php

namespace Tests\Unit\Components;

use App\Http\Livewire\FollowButton;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FollowButtonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_follows_users()
    {
        $user = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(FollowButton::class, [
            'user' => $following,
        ])->call('follow');

        $this->assertTrue($user->following()->get()->contains($following));
    }

    /**
     * @test
     */
    public function it_unfollows_users()
    {
        $user = User::factory()->create();
        $following = User::factory()->create();
        $user->following()->attach($following);

        $this->actingAs($user);

        $this->assertTrue($user->following()->get()->contains($following));

        Livewire::test(FollowButton::class, [
            'user' => $following,
        ])->call('unfollow');

        $this->assertFalse($user->following()->get()->contains($following));
    }
}
