<?php

namespace Tests\Unit;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_storage_url()
    {
        Storage::fake();
        $path = Storage::putFile('media', UploadedFile::fake()->image('photo1.jpg'));
        $media = Media::factory()->create([
            'location' => $path,
        ]);

        $this->assertStringEndsWith($path, $media->url);
    }
}
