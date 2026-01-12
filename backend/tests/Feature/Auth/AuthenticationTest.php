<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('login route exists', function () {
    expect(\Illuminate\Support\Facades\Route::has('login'))->toBeTrue();
});

test('users can authenticate with email', function () {
    $this->post('/login', [
        'login' => $this->user->email,
        'password' => 'password',
    ])->assertRedirect(route('posts.index', absolute: false));

    $this->assertAuthenticated();
});

test('users can authenticate with username', function () {
    $this->post('/login', [
        'login' => $this->user->name,
        'password' => 'password',
    ])->assertRedirect(route('posts.index', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $this->post('/login', [
        'login' => $this->user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $this->actingAs($this->user)
        ->post('/logout')
        ->assertRedirect(route('login', absolute: false));

    $this->assertGuest();
});
