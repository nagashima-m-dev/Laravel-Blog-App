<?php

it('redirects to posts index', function () {
    $this->get('/')->assertRedirect('/posts');
});
