<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_update_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->patch(route('posts.update', $post), [
            'title' => 'Updated title',
            'body' => 'Updated body',
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_update_other_users_post(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($other);

        $response = $this->patch(route('posts.update', $post), [
            'title' => 'Updated title',
            'body' => 'Updated body',
        ]);

        $response->assertForbidden();
    }

    public function test_user_can_update_own_post_and_redirect_to_show(): void
    {
        $owner = User::factory()->create();
        $post = Post::factory()->for($owner)->create([
            'title' => 'Old title',
            'body' => 'Old body',
        ]);

        $this->actingAs($owner);

        $response = $this->patch(route('posts.update', $post), [
            'title' => 'New title',
            'body' => 'New body',
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'New title',
            'body' => 'New body',
        ]);

        $response->assertRedirect(route('posts.show', $post));
    }
}
