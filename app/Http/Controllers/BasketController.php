<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketExtra;
use App\Models\BasketItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function addToBasket(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'item_id' => 'required|integer|exists:menu_items,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'image_path' => 'required|string',
            'price' => 'required|integer',
            'actual_price' => 'required|integer',
            'discount_amount' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'category_name' => 'required|string',
            'compositions' => 'required|array',
            'compositions.*.ingredient_id' => 'required|integer|exists:ingredients,id',
            'compositions.*.ingredient_name' => 'required|string',
            'compositions.*.extra_price' => 'required|integer',
            'compositions.*.quantity' => 'required|integer',
        ]);

        $basket = Basket::firstOrCreate(
            ['user' => $data['user_id']],
            ['total_amount' => 0]
        );

        $basketItem = BasketItem::create([
            'basket_id' => $basket->id,
            'item_id' => $data['item_id'],
            'buying_price' => $data['actual_price']
        ]);

        foreach ($data['compositions'] as $composition) {

            if ($composition['quantity'] != 1) {
                BasketExtra::create([
                    'basket_item_id' => $basketItem->id,
                    'ingredient' => $composition['ingredient_id'],
                    'quantity' => $composition['quantity']
                ]);
            }
        }

        $basket->increment('total_amount', $data['actual_price']);

        return $this->getUserBasket();
    }

    public function orderBasket()
    {
        $userId = Auth::id();

        $basket = Basket::with(['items.extras'])->where('user', $userId)->first();

        if (!$basket) {
            return response()->json(['message' => 'Kosár nem találva'], 404);
        }

        $order = Order::create([
            'user_id' => $userId,
            'total' => $basket->total_amount,
        ]);

        foreach ($basket->items as $basketItem) {
            $orderItem = $order->orderItems()->create([
                'menu_item_id' => $basketItem->item_id,
                'buying_price' => $basketItem->buying_price,
            ]);

            foreach ($basketItem->extras as $basketExtra) {
                $orderItem->extras()->create([
                    'ingredient_id' => $basketExtra->ingredient,
                    'quantity' => $basketExtra->quantity,
                ]);
            }
        }

        return response()->json(['message' => 'Rendelés sikeresen leadva'], 200);
    }

    public function getUserBasket()
    {
        $userId = Auth::id();

        $basket = Basket::with(['items.extras.ingredient', 'items.menuItem'])
            ->where('user', $userId)
            ->first();

        if (!$basket) {
            return response()->json(['message' => 'Kosár nem találva'], 404);
        }

        return response()->json($basket, 200);
    }

    public function deleteBasketItem($id)
    {
        $userId = Auth::id();

        $basketItem = BasketItem::where('id', $id)
            ->whereHas('basket', function ($query) use ($userId) {
                $query->where('user', $userId);
            })
            ->first();

        if (!$basketItem) {
            return response()->json(['message' => 'Kosár tétel nem találva'], 404);
        }

        $basket = $basketItem->basket;
        $basket->decrement('total_amount', $basketItem->buying_price);

        $basketItem->extras()->delete();
        $basketItem->delete();

        return $this->getUserBasket();
    }
}
