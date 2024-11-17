<?php

it('redirects to the products page', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirect('/products');
});
