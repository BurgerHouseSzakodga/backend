<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemRequest;
use App\Models\Composition;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index()
    {
        return MenuItem::with(['category', 'compositions'])
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
                    'compositions' => $menuItem->compositions->pluck('ingredient_id')->toArray(),
                ];
            });
    }

    public function updateName(MenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->name = $request->name;
        $menuItem->save();

        return response()->json(['message' => 'Name updated successfully', 'menuItem' => $menuItem]);
    }

    public function updatePrice(MenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->price = $request->price;
        $menuItem->save();

        return response()->json(['message' => 'Price updated successfully', 'menuItem' => $menuItem]);
    }

    public function updateCategory(MenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->category_id = $request->category_id;
        $menuItem->save();

        return response()->json(['message' => 'Category updated successfully', 'menuItem' => $menuItem]);
    }

    public function updateImage(MenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        if ($menuItem->image_path) {
            $oldImagePath = public_path(parse_url($menuItem->image_path, PHP_URL_PATH));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);

        $menuItem->image_path = 'http://localhost:8000/images/' . $imageName;
        $menuItem->save();

        return response()->json(['message' => 'Image updated successfully', 'menuItem' => $menuItem]);
    }

    public function store(MenuItemRequest $request)
    {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);

        $menuItem = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image_path' => 'http://localhost:8000/images/' . $imageName,
            'price' => $request->price,
        ]);

        foreach ($request->composition as $ingredientId) {
            Composition::create([
                'menu_item_id' => $menuItem->id,
                'ingredient_id' => $ingredientId,
            ]);
        }

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Menu item created successfully',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],

        ], 201);
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);

        if ($menuItem->image_path) {
            $imagePath = public_path(parse_url($menuItem->image_path, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $menuItem->delete();

        return response()->json(['message' => 'Menu item deleted successfully']);
    }
}
