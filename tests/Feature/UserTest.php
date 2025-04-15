<?php

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

test('a felhasználó csak a saját rendeléseit láthatja', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $order1 = Order::factory()->create(['user_id' => $user1->id]);
    $order2 = Order::factory()->create(['user_id' => $user2->id]);

    actingAs($user1);

    $response = getJson('/api/user/order/' . $user1->id);
    $response->assertOk();

    $responseData = collect($response->json());
    expect($responseData->pluck('id'))->toContain($order1->id);
    expect($responseData->pluck('id'))->not->toContain($order2->id);
});

test('az admin mindenkinek a rendelését láthatja', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $orders = Order::factory()->count(3)->create();

    actingAs($admin);

    $response = getJson('/api/orders');
    $response->assertOk();

    $responseData = collect($response->json());
    foreach ($orders as $order) {
        expect($responseData->pluck('id'))->toContain($order->id);
    }
});

test('a felhasználó megváltoztathatja a jelszavát', function () {
    $user = User::factory()->create([
        'password' => Hash::make('EredetiJelszo'),
    ]);
    actingAs($user);

    $response = putJson('/api/user/password', [
        'current_password' => 'EredetiJelszo',
        'new_password' => 'UjJelszo123',
        'new_password_confirmation' => 'UjJelszo123',
    ]);

    $response->assertOk();
    $user->refresh();
    expect(Hash::check('UjJelszo123', $user->password))->toBeTrue();
});
