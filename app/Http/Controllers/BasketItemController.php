<?php

namespace App\Http\Controllers;

use App\Models\BasketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketItemController extends Controller
{
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

        $basketItem->extras()->delete();
        $basketItem->delete();

        return response()->json(['message' => 'Kosár tétel sikeresen törölve'], 200);
    }
}
