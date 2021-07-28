<?php

namespace Tests\Feature;

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
    public function it_renders_feed()
    {
        Storage::fake();

        $user = User::factory()->create();
        $following = User::factory()->hasMedia(3)->create();
        $user->following()->attach($following);

        $this->actingAs($user)->get('/feed')
            ->assertStatus(200)
            ->assertSeeLivewire('feed')
            ->assertSeeLivewire('media-item');
    }

    /**
     * @test
     */
    public function it_redirects_guests_to_login()
    {
        $this->get('/feed')->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_renders_user_profile_feed()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->actingAs(User::factory()->create())
            ->get(route('profile', $user))
            ->assertStatus(200)
            ->assertViewIs('feed')
            ->assertSeeLivewire('feed')
            ->assertSeeLivewire('media-item');
    }

    /**
     * @test
     */
    public function it_renders_user_profile_feed_for_guests()
    {
        Storage::fake();

        $user = User::factory()->hasMedia(3)->create();

        $this->get(route('profile', $user))
            ->assertStatus(200)
            ->assertViewIs('feed')
            ->assertSeeLivewire('feed')
            ->assertSeeLivewire('media-item');
    }
}
