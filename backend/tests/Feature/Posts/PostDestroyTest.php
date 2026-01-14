<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_delete_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_delete_other_users_post(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($other);

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertForbidden();
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_user_can_delete_own_post_and_redirect_to_index(): void
    {
        $owner = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($owner);

        $response = $this->delete(route('posts.destroy', $post));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
        $response->assertRedirect(route('posts.index'));
    }
}
