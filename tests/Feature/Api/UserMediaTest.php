<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserMediaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_user_media()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->actingAs($user)
            ->get(route('api.v1.user.media', $user))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'url',
                        'user' => [
                            'id',
                            'name',
                            'username',
                        ],
                    ],
                ],
                'links' => [],
                'meta'  => [],
            ]);
    }

    /**
     * @test
     */
    public function it_returns_other_user_media()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->actingAs(User::factory()->create())
            ->get(route('api.v1.user.media', $user))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'url',
                        'user' => [
                            'id',
                            'name',
                            'username',
                        ],
                    ],
                ],
                'links' => [],
                'meta'  => [],
            ]);
    }
}
