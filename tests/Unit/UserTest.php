<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_includes_followed_media_in_feed_media()
    {
        $following = User::factory()->hasMedia()->create();
        $user = User::factory()->create();
        $user->following()->attach($following);

        $this->assertTrue($user->feed_media->get()->contains($following->media()->first()->id));
    }

    /**
     * @test
     */
    public function it_does_not_include_unfollowed_media_in_feed_media()
    {
        $following = User::factory()->hasMedia()->create();
        $user = User::factory()->create();

        $this->assertFalse($user->feed_media->get()->contains($following->media()->first()->id));
    }

    /**
     * @test
     */
    public function it_does_not_include_own_media_in_feed_media()
    {
        $user = User::factory()->hasMedia()->create();

        $this->assertFalse($user->feed_media->get()->contains($user->media()->first()->id));
    }
}
