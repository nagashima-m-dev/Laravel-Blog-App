<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostUpdateValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_required_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $this->actingAs($user);

        $this->from(route('posts.edit', $post))
            ->patch(route('posts.update', $post), [
                'title' => '',
                'body' => '',
            ]);

        $errors = session('errors')->getBag('default')->toArray();

        $expectedTitleMessage = __('validation.required', [
            'attribute' => __('validation.attributes.title'),
        ]);
        $expectedBodyMessage = __('validation.required', [
            'attribute' => __('validation.attributes.body'),
        ]);

        $this->assertSame($expectedTitleMessage, $errors['title'][0]);
        $this->assertSame($expectedBodyMessage, $errors['body'][0]);
    }

    public function test_update_string_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $this->actingAs($user);

        $this->from(route('posts.edit', $post))
            ->patch(route('posts.update', $post), [
                'title' => ['not', 'string'],
                'body' => ['not', 'string'],
            ]);

        $errors = session('errors')->getBag('default')->toArray();

        $expectedTitleMessage = __('validation.string', [
            'attribute' => __('validation.attributes.title'),
        ]);
        $expectedBodyMessage = __('validation.string', [
            'attribute' => __('validation.attributes.body'),
        ]);

        $this->assertSame($expectedTitleMessage, $errors['title'][0]);
        $this->assertSame($expectedBodyMessage, $errors['body'][0]);
    }

    public function test_update_title_max_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $this->actingAs($user);

        $max = 255;
        $tooLongTitle = str_repeat('a', $max + 1);

        $this->from(route('posts.edit', $post))
            ->patch(route('posts.update', $post), [
                'title' => $tooLongTitle,
                'body' => 'ok body',
            ]);

        $errors = session('errors')->getBag('default')->toArray();

        $expectedTitleMessage = __('validation.max.string', [
            'attribute' => __('validation.attributes.title'),
            'max' => $max,
        ]);

        $this->assertSame($expectedTitleMessage, $errors['title'][0]);
    }

    public function test_update_body_max_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $this->actingAs($user);

        $max = 10000;
        $tooLongBody = str_repeat('a', $max + 1);

        $this->from(route('posts.edit', $post))
            ->patch(route('posts.update', $post), [
                'title' => 'ok title',
                'body' => $tooLongBody,
            ]);

        $errors = session('errors')->getBag('default')->toArray();

        $expectedBodyMessage = __('validation.max.string', [
            'attribute' => __('validation.attributes.body'),
            'max' => $max,
        ]);

        $this->assertSame($expectedBodyMessage, $errors['body'][0]);
    }
}
