<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketExtra;
use App\Models\BasketItem;
use Illuminate\Http\Request;

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
        ]);

        foreach ($data['compositions'] as $composition) {
            $modificationType = $composition['quantity'] > 1;

            if ($composition['quantity'] != 1) {
                BasketExtra::create([
                    'basket_item_id' => $basketItem->id,
                    'ingredient' => $composition['ingredient_id'],
                    'modification_type' => $modificationType,
                    'quantity' => $composition['quantity']
                ]);
            }
        }

        $basket->increment('total_amount', $data['actual_price']);

        return response()->json(['message' => 'Item added to basket successfully'], 201);
    }
}
