<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_post_edit(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.edit', $post));

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_view_other_users_post_edit(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $post = Post::factory()->for($owner)->create();

        $this->actingAs($other);

        $response = $this->get(route('posts.edit', $post));

        $response->assertForbidden(); // 403
    }

    public function test_user_can_view_own_post_edit(): void
    {
        $owner = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($owner);

        $response = $this->get(route('posts.edit', $post));

        $response->assertOk();
    }
}
