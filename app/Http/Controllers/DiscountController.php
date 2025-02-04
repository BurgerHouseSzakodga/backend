<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $menuItemsInDiscounts = MenuItem::whereIn('id', Discount::pluck('menu_item_id'))->get();
        return response()->json($menuItemsInDiscounts, 200);
    }

    public function notInDiscounts()
    {
        $menuItemsNotInDiscounts = MenuItem::whereNotIn('id', Discount::pluck('menu_item_id'))->get();
        return response()->json($menuItemsNotInDiscounts, 200);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'discount_amount' => 'sometimes|integer|min:1|max:100',
        ]);

        $discount = Discount::create([
            'menu_item_id' => $id,
            'discount_amount' => $request->input('discount_amount'),
        ]);

        return response()->json($discount, 201);
    }

    public function destroy($id)
    {
        $discount = Discount::where('menu_item_id', $id)->first();

        if ($discount) {
            $discount->delete();
            return response()->json(['message' => 'Sikeres törlés.'], 200);
        } else {
            return response()->json(['message' => 'Leárazás hiba.'], 404);
        }
    }

    public function updateDiscountAmount(Request $request, $id)
    {
        $request->validate([
            'discount_amount' => 'required|integer|min:1|max:100',
        ]);

        $discount = Discount::where('menu_item_id', $id)->first();

        if ($discount) {
            $discount->discount_amount = $request->discount_amount;
            $discount->save();
            return response()->json($discount, 200);
        } else {
            return response()->json(['message' => 'Leárazás hiba.'], 404);
        }
    }
}
