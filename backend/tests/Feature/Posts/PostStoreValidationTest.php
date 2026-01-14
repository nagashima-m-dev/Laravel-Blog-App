<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostStoreValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_required_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('posts.create'))
            ->post(route('posts.store'), [
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

    public function test_store_string_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('posts.create'))
            ->post(route('posts.store'), [
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

    public function test_store_title_max_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $max = 255;
        $tooLongTitle = str_repeat('a', $max + 1);

        $this->from(route('posts.create'))
            ->post(route('posts.store'), [
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

    public function test_store_body_max_messages_are_in_japanese(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $max = 10000;
        $tooLongBody = str_repeat('a', $max + 1);

        $this->from(route('posts.create'))
            ->post(route('posts.store'), [
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
