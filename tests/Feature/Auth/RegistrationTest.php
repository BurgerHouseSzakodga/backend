<?php

use App\Models\User;

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'address' => 'Test Address',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});

test('azonosEmailCim', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com'
    ]);

    $response = $this->postJson('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'address' => 'Test Address',
    ]);

    $this->assertEquals(422, $response->status());
    $response->assertJsonValidationErrors(['email']);
    $response->assertJson([
        'message' => 'Ez az email cím már foglalt.',
        'errors' => [
            'email' => ['Ez az email cím már foglalt.']
        ]
    ]);


});

