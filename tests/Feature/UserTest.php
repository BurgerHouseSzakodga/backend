<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function menuItemsGet()
    {
        $response = $this->get('/api/menu-items');
        $response->assertStatus(200);
    }

    public function postMenuItems()
    {
        $response = $this->post('/api/menu-items', [
            'name' => 'Test',
            'price' => 1000,
            'category_id' => 1,
            'description' => 'Test',
            'composition' => 'Test'
        ]);
        $response->assertStatus(201);
    }
}
