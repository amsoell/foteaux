<?php

namespace Tests\Unit\Components;

use App\Actions\Follow;
use App\Actions\Unfollow;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowTest extends TestCase
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
        (new Follow())($following);

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
        (new Unfollow())($following);

        $this->assertFalse($user->following()->get()->contains($following));
    }
}
