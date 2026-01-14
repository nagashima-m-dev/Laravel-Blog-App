<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PostCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_post_create(): void
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_store_post(): void
    {
        $response = $this->post(route('posts.store'), [
            'title' => 'test title',
            'body' => 'test body',
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_store_post_and_redirect_to_show(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = [
            'title' => 'My title',
            'body' => 'My body',
        ];

        $response = $this->post(route('posts.store'), $payload);

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => 'My title',
            'body' => 'My body',
        ]);

        $postId = \App\Models\Post::where('title', 'My title')->value('id');
        $response->assertRedirect(route('posts.show', $postId));
    }
}
