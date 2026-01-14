<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_posts_index(): void
    {
        Post::factory()->count(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertOk();
    }
}
