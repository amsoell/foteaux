<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_returns_user_profile_data()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->actingAs(User::factory()->create())
            ->get(route('api.v1.user.show', $user))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_returns_other_user_profile_data()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->actingAs(User::factory()->create())->get(route('api.v1.user.show', $user))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                ],
            ]);
    }

    /**
     * @test
     */
    public function it_allows_updates_to_own_profile()
    {
        Storage::fake();

        $user = User::factory()->create();
        $data = [
            'name'     => $this->faker->name(),
            'email'    => $this->faker->email(),
            'username' => $this->faker->word(),
        ];

        $this->actingAs($user)
            ->patch(route('api.v1.user.update', $user), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                ],
            ]);

        $this->assertEmpty(
            array_diff($user->fresh()->only(array_keys($data)), $data)
        );
    }

    /**
     * @test
     */
    public function it_does_not_allow_updates_to_other_profile()
    {
        Storage::fake();

        $user = User::factory()->create();
        $data = [
            'name'     => $this->faker->name(),
            'email'    => $this->faker->email(),
            'username' => $this->faker->word(),
        ];

        $this->actingAs(User::factory()->create())
            ->patch(route('api.v1.user.update', $user), $data)
            ->assertForbidden();

        $this->assertCount(
            3,
            array_diff($user->fresh()->only(array_keys($data)), $data)
        );
    }

    /**
     * @test
     */
    public function it_does_not_require_all_attributes_when_updating()
    {
        Storage::fake();

        $user = User::factory()->create();
        $data = [
            'email' => $this->faker->email(),
        ];

        $this->actingAs($user)
            ->patch(route('api.v1.user.update', $user), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                ],
            ]);

        $this->assertEmpty(
            array_diff($user->fresh()->only(array_keys($data)), $data)
        );
    }
}
