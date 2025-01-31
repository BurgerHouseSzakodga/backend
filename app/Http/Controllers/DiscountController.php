<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        return Discount::all();
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
        Discount::findOrFail($id)->delete();
    }
}
