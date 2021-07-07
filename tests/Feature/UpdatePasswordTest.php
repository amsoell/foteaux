<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_updates_passwords()
    {
        $this->actingAs($user = User::factory()->create());

        $new_password = $this->faker->password(minLength: 8);

        Livewire::test(UpdatePasswordForm::class)
                ->set('state', [
                    'current_password' => 'password',
                    'password' => $new_password,
                    'password_confirmation' => $new_password,
                ])
                ->call('updatePassword');

        $this->assertTrue(Hash::check($new_password, $user->fresh()->password));
    }

    /**
     * @test
     */
    public function it_prevents_updating_password_without_current_password()
    {
        $this->actingAs($user = User::factory()->create());

        $new_password = $this->faker->password(minLength: 8);

        Livewire::test(UpdatePasswordForm::class)
                ->set('state', [
                    'current_password' => 'wrong-password',
                    'password' => $new_password,
                    'password_confirmation' => $new_password,
                ])
                ->call('updatePassword')
                ->assertHasErrors(['current_password']);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    /**
     * @test
     */
    public function it_prevents_updating_password_with_mismatched_new_passwords()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdatePasswordForm::class)
                ->set('state', [
                    'current_password' => 'password',
                    'password' => $this->faker->password(minLength: 8),
                    'password_confirmation' => $this->faker->password(minLength: 8),
                ])
                ->call('updatePassword')
                ->assertHasErrors(['password']);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
