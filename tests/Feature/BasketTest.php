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

test('can add an item to the basket', function () {
    $menuItem = MenuItem::factory()->create();

    $response = $this->postJson('/api/add-to-basket', [
        'item_id' => $menuItem->id,
        'quantity' => 1,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('basket_items', [
        'item_id' => $menuItem->id,
        'quantity' => 1,
    ]);
});

test('can retrieve the user basket', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id]);
    $basketItem = BasketItem::factory()->create(['basket_id' => $basket->id]);

    $response = $this->getJson('/api/basket');

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $basket->id]);
});

test('can delete an item from the basket', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id]);
    $basketItem = BasketItem::factory()->create(['basket_id' => $basket->id]);

    $response = $this->deleteJson("/api/delete-basket-item/{$basketItem->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('basket_items', ['id' => $basketItem->id]);
});

test('can order the basket', function () {
    $basket = Basket::factory()->create(['user' => $this->user->id, 'total_amount' => 1000]);
    $basketItem = BasketItem::factory()->create(['basket_id' => $basket->id, 'buying_price' => 1000]);

    $response = $this->postJson('/api/order-basket');

    $response->assertStatus(200);
    $this->assertDatabaseHas('orders', [
        'user_id' => $this->user->id,
        'total' => 1000,
    ]);
    $this->assertDatabaseMissing('baskets', ['id' => $basket->id]);
});
