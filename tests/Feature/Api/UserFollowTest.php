<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserFollowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_follows_users()
    {
        Storage::fake();

        $user = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($user)
            ->post(route('api.v1.user.follow.store', $following))
            ->assertNoContent();

        $this->assertTrue($user->following->contains($following));
    }

    /**
     * @test
     */
    public function it_unfollows_users()
    {
        Storage::fake();

        $user = User::factory()->create();
        $following = User::factory()->create();
        $user->following()->attach($following);

        $this->actingAs($user)
            ->delete(route('api.v1.user.follow.delete', $following))
            ->assertNoContent();

        $this->assertDatabaseMissing('follows', [
            'user_id'         => $user->id,
            'follows_user_id' => $following->id,
        ]);

        $this->assertFalse($user->following->contains($following));
    }

    /**
     * @test
     */
    public function it_returns_error_when_following_self()
    {
        Storage::fake();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('api.v1.user.follow.store', $user))
            ->assertStatus(406);

        $this->assertDatabaseMissing('follows', [
            'user_id'         => $user->id,
            'follows_user_id' => $user->id,
        ]);

        $this->assertFalse($user->following->contains($user));
    }
}
