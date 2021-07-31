<?php

namespace Tests\Unit\Components;

use App\Http\Livewire\Upload;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_shows_upload_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('upload'))
            ->assertSuccessful()
            ->assertSeeLivewire('upload');
    }

    /**
     * @test
     */
    public function it_uploads_files()
    {
        Storage::fake();

        $user = User::factory()->create();
        $filename = 'photo.jpg';
        $file = UploadedFile::fake()->image($filename);

        $this->actingAs($user);

        Livewire::test(Upload::class)
             ->set('caption', $this->faker->words(10, true))
             ->set('media', $file)
             ->call('save');

        $this->assertCount(1, $user->media);
        Storage::assertExists($user->media->first()->location);
    }

    /**
     * @test
     */
    public function it_displays_file_preview()
    {
        Storage::fake();

        $user = User::factory()->create();
        $filename = 'photo.jpg';
        $file = UploadedFile::fake()->image($filename);

        $this->actingAs($user);

        Livewire::test(Upload::class)
             ->set('caption', $this->faker->words(10, true))
             ->set('media', $file)
             ->assertSee('preview-file');
    }

    /**
     * @test
     */
    public function it_redirects_to_feed_after_upload()
    {
        Storage::fake();

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('photo.jpg');

        $this->actingAs($user);

        Livewire::test(Upload::class)
             ->set('caption', $this->faker->words(10, true))
             ->set('media', $file)
             ->call('save')
             ->assertRedirect(route('profile', [
                 'user' => $user,
             ]));
    }

    /**
     * @test
     */
    public function it_rejects_non_image_uploads()
    {
        Storage::fake();

        $user = User::factory()->create();
        $filename = 'document.pdf';
        $file = UploadedFile::fake()->create($filename, 300);

        $this->actingAs($user);

        Livewire::test(Upload::class)
             ->set('caption', $this->faker->words(10, true))
             ->set('media', $file)
             ->call('save');

        $this->assertCount(0, $user->media);
    }

    /**
     * @test
     */
    public function it_rejects_large_uploads()
    {
        Storage::fake();

        $user = User::factory()->create();
        $filename = 'photo.jpg';
        $file = UploadedFile::fake()->create($filename, 1100, 1100);

        $this->actingAs($user);

        Livewire::test(Upload::class)
             ->set('caption', $this->faker->words(10, true))
             ->set('media', $file)
             ->call('save');

        $this->assertCount(0, $user->media);
    }
}
