<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_post_show(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertOk();
    }
}
