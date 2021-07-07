<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_renders_password_confirmation_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/user/confirm-password');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_confirms_password()
    {
        $response = $this->actingAs(User::factory()->create())->post('/user/confirm-password', [
            'password' => 'password',
        ])->assertRedirect()
            ->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
    public function it_does_not_confirm_incorrect_password()
    {
        $this->actingAs(User::factory()->create())->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ])->assertSessionHasErrors();
    }
}
