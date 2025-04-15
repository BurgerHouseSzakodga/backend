<?php

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('a felhasználó tud terméket a kosárba rakni', function () {
    $menuItem = MenuItem::factory()->create();
    $ingredient = Ingredient::factory()->create();

    $response = $this->postJson('/api/add-to-basket', [
        'user_id' => $this->user->id,
        'item_id' => $menuItem->id,
        'name' => $menuItem->name,
        'description' => $menuItem->description,
        'image_path' => $menuItem->image_path,
        'price' => $menuItem->price,
        'actual_price' => $menuItem->price,
        'discount_amount' => 0,
        'category_id' => $menuItem->category_id,
        'category_name' => $menuItem->category->name,
        'quantity' => 1,
        'compositions' => [
            [
                'ingredient_id' => $ingredient->id,
                'ingredient_name' => $ingredient->name,
                'extra_price' => $ingredient->extra_price,
                'quantity' => 1,
            ],
        ],
    ]);


    $response->assertStatus(200);
    $this->assertDatabaseHas('basket_items', [
        'item_id' => $menuItem->id,
        'buying_price' => $menuItem->price,
    ]);
});

test('a felhasználó látja a saját kosarát', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id]);
    $basketItem = BasketItem::factory()->create([
        'basket_id' => $basket->id,
        'buying_price' => 1000,
    ]);

    $response = $this->getJson('/api/basket');

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $basket->id]);
});

test('a felhasználó tud terméket törölni a kosárból', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id]);
    $basketItem = BasketItem::factory()->create([
        'basket_id' => $basket->id,
        'buying_price' => 1000,
    ]);

    $response = $this->deleteJson("/api/delete-basket-item/{$basketItem->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('basket_items', ['id' => $basketItem->id]);
});

test('a kosár megrendelhető', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id, 'total_amount' => 1000]);
    $basketItem = BasketItem::factory()->create([
        'basket_id' => $basket->id,
        'buying_price' => 1000,
    ]);

    $response = $this->postJson('/api/order-basket');

    $response->assertStatus(200);
    $this->assertDatabaseHas('orders', [
        'user_id' => $this->user->id,
        'total' => 1000,
    ]);
    $this->assertDatabaseHas('baskets', ['id' => $basket->id]);
});
