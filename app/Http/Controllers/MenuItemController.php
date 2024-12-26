<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    //get minden étel lekérése
    public function index()
    {
        return MenuItem::with('category')
            ->get()
            ->map(function ($menuItem) {
                return [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'image_path' => $menuItem->image_path,
                    'price' => $menuItem->price,
                    'category_id' => $menuItem->category_id,
                    'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                ];
            });
    }

    public function updateName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:25',
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->name = $request->name;
        $menuItem->save();

        return response()->json(['message' => 'Name updated successfully', 'menuItem' => $menuItem]);
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|integer|min:1',
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->price = $request->price;
        $menuItem->save();

        return response()->json(['message' => 'Price updated successfully', 'menuItem' => $menuItem]);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->category_id = $request->category_id;
        $menuItem->save();

        return response()->json(['message' => 'Category updated successfully', 'menuItem' => $menuItem]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);

        $menuItem = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image_path' => 'http://localhost:8000/images/' . $imageName,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'Menu item created successfully', 'menuItem' => $menuItem], 201);
    }
}
