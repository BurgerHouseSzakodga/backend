<?php

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->admin()->create();
    $this->actingAs($this->user);
});

test('az admin létre tud hozni terméket', function () {
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

test('termék név módosítás', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/name", [
        'name' => 'Updated Item',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['name' => 'Updated Item']);
});

test('termék ár módosítás', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/price", [
        'price' => 1500,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['price' => 1500]);
});

test('termék kategória módosítás', function () {
    $menuItem = MenuItem::factory()->create();
    $newCategory = Category::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/category", [
        'category_id' => $newCategory->id,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['category_id' => $newCategory->id]);
});

test('termék leírás módosítás', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->putJson("/api/menu-items/{$menuItem->id}/description", [
        'description' => 'Updated Description',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('menu_items', ['description' => 'Updated Description']);
});

test('termék törlése', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->deleteJson("/api/menu-items/{$menuItem->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('menu_items', ['id' => $menuItem->id]);
});
