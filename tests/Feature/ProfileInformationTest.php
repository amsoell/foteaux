<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_displays_user_information_on_profile()
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->name, $component->state['name']);
        $this->assertEquals($user->email, $component->state['email']);
        $this->assertEquals($user->username, $component->state['username']);
    }

    /**
     * @test
     */
    public function it_updates_user_profile()
    {
        $this->actingAs($user = User::factory()->create());

        $new_profile = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'username' => preg_replace("/[^A-Za-z0-9 ]/", '', $this->faker->username()),
        ];

        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', $new_profile)
                ->call('updateProfileInformation');

        $this->assertEquals($new_profile['name'], $user->fresh()->name);
        $this->assertEquals($new_profile['email'], $user->fresh()->email);
    }
}
