<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration required messages are in japanese', function () {
    $this->from('/register')
        ->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['name'][0])->toBe(
        __('validation.required', ['attribute' => __('validation.attributes.name')])
    );

    expect($errors['email'][0])->toBe(
        __('validation.required', ['attribute' => __('validation.attributes.email')])
    );

    expect($errors['password'][0])->toBe(
        __('validation.required', ['attribute' => __('validation.attributes.password')])
    );
});

test('registration max messages are in japanese', function () {
    $tooLong = str_repeat('a', 256);

    $this->from('/register')
        ->post('/register', [
            'name' => $tooLong,
            'email' => $tooLong . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['name'][0])->toBe(
        __('validation.max.string', [
            'attribute' => __('validation.attributes.name'),
            'max' => 255,
        ])
    );

    expect($errors['email'][0])->toBe(
        __('validation.max.string', [
            'attribute' => __('validation.attributes.email'),
            'max' => 255,
        ])
    );
});

test('registration unique messages are in japanese', function () {
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    $this->from('/register')
        ->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['name'][0])->toBe(
        __('validation.unique', ['attribute' => __('validation.attributes.name')])
    );

    expect($errors['email'][0])->toBe(
        __('validation.unique', ['attribute' => __('validation.attributes.email')])
    );
});

test('registration confirmed password message is in japanese', function () {
    $this->from('/register')
        ->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different',
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['password'][0])->toBe(
        __('validation.confirmed', ['attribute' => __('validation.attributes.password')])
    );
});
