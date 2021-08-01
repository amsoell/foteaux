<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_feed()
    {
        Storage::fake();

        $user = User::factory()->create();
        $following = User::factory()->hasMedia(3)->create();
        $user->following()->attach($following);

        $this->actingAs($user)->get(route('api.v1.feed'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'  => [],
                'links' => [],
                'meta'  => [],
            ]);
    }

    /**
     * @test
     */
    public function it_returns_errors_for_guests()
    {
        $this->get(route('api.v1.feed'))->assertUnauthorized();
    }
}
