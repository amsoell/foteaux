<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_renders_registration_view()
    {
        $this->get('/register')->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_allows_users_to_register()
    {
        $password = $this->faker->password(minLength: 8);

        $this->post('/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'username' => preg_replace("/[^A-Za-z0-9 ]/", '', $this->faker->username()),
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }
}
