<?php

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Composition;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->admin()->create();
    $this->actingAs($this->user);
});

test('can create a menu item', function () {
    $category = Category::factory()->create();
    $ingredient = Ingredient::factory()->create();

    $response = $this->postJson('/api/menu-items', [
        'name' => 'Test Item',
        'description' => 'Test Description',
        'category_id' => $category->id,
        'price' => 1000,
        'composition' => [$ingredient->id],
        'image' => UploadedFile::fake()->image('test.jpg')
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['name' => 'Test Item']);
});

test('can update a menu item name', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/name", [
        'name' => 'Updated Item',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['name' => 'Updated Item']);
});

test('can update a menu item price', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/price", [
        'price' => 1500,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['price' => 1500]);
});

test('can update a menu item category', function () {
    $menuItem = MenuItem::factory()->create();
    $newCategory = Category::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/category", [
        'category_id' => $newCategory->id,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['category_id' => $newCategory->id]);
});

test('can update a menu item description', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/description", [
        'description' => 'Updated Description',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['description' => 'Updated Description']);
});

test('can delete a menu item', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->deleteJson("/api/menu-items/{$menuItem->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('menu_items', ['id' => $menuItem->id]);
});
