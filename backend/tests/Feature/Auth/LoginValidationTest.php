<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('login required messages are in japanese', function () {
    $this->from('/login')
        ->post('/login', [
            'login' => '',
            'password' => '',
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['login'][0])->toBe(
        __('validation.required', ['attribute' => __('validation.attributes.login')])
    );

    expect($errors['password'][0])->toBe(
        __('validation.required', ['attribute' => __('validation.attributes.password')])
    );
});

test('login string messages are in japanese', function () {
    $this->from('/login')
        ->post('/login', [
            'login' => ['not', 'string'],
            'password' => ['not', 'string'],
        ]);

    $errors = session('errors')->getBag('default')->toArray();

    expect($errors['login'][0])->toBe(
        __('validation.string', ['attribute' => __('validation.attributes.login')])
    );

    expect($errors['password'][0])->toBe(
        __('validation.string', ['attribute' => __('validation.attributes.password')])
    );
});
