<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\Category;
use App\Models\Composition;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    public function index()
    {
        return MenuItem::with(['category', 'compositions.ingredient'])
            ->get()
            ->map(function ($menuItem) {
                return [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'image_path' => $menuItem->image_path,
                    'price' => $menuItem->price,
                    'actual_price' => $menuItem->actual_price,
                    'discount_amount' => $menuItem->discount_amount,
                    'category_id' => $menuItem->category_id,
                    'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                    'compositions' => $menuItem->compositions->pluck('ingredient_id')->toArray(),
                ];
            });
    }

    public function menuItemWithIngerdeints()
    {
        return MenuItem::with(['category',  'compositions.ingredient'])
            ->get()
            ->map(function ($menuItem) {
                return [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'image_path' => $menuItem->image_path,
                    'price' => $menuItem->price,
                    'actual_price' => $menuItem->actual_price,
                    'discount_amount' => $menuItem->discount_amount,
                    'category_id' => $menuItem->category_id,
                    'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                    'compositions' => $menuItem->compositions->map(function ($composition) {
                        return [
                            'ingredient_id' => $composition->ingredient_id,
                            'ingredient_name' => $composition->ingredient->name,
                            'quantity' => 1
                        ];
                    })->toArray(),
                ];
            });
    }

    public function menuItemWithIngredients($id)
    {
        $menuItem = MenuItem::with(['category', 'compositions.ingredient'])
            ->findOrFail($id);

        return response()->json([
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'description' => $menuItem->description,
            'image_path' => $menuItem->image_path,
            'price' => $menuItem->price,
            'actual_price' => $menuItem->actual_price,
            'discount_amount' => $menuItem->discount_amount,
            'category_id' => $menuItem->category_id,
            'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
            'compositions' => $menuItem->compositions->map(function ($composition) {
                return [
                    'ingredient_id' => $composition->ingredient_id,
                    'ingredient_name' => $composition->ingredient->name,
                    'extra_price' => $composition->ingredient->extra_price,
                    'quantity' => 1
                ];
            })->toArray(),
        ]);
    }

    public function discountedItems()
    {
        return MenuItem::with(['category', 'compositions'])
            ->where('discount_amount', '>', 0)
            ->get()
            ->map(function ($menuItem) {
                return [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'image_path' => $menuItem->image_path,
                    'price' => $menuItem->price,
                    'actual_price' => $menuItem->actual_price,
                    'discount_amount' => $menuItem->discount_amount,
                    'category_id' => $menuItem->category_id,
                    'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                    'compositions' => $menuItem->compositions->pluck('ingredient_id')->toArray(),
                ];
            });
    }

    public function notInDiscounts()
    {
        return MenuItem::with(['category', 'compositions'])
            ->where('discount_amount', '=', 0)
            ->where('category_id', '!=', 3)
            ->get()
            ->map(function ($menuItem) {
                return [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'image_path' => $menuItem->image_path,
                    'price' => $menuItem->price,
                    'actual_price' => $menuItem->actual_price,
                    'discount_amount' => $menuItem->discount_amount,
                    'category_id' => $menuItem->category_id,
                    'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                    'compositions' => $menuItem->compositions->pluck('ingredient_id')->toArray(),
                ];
            });
    }

    public function updateDiscountAmount(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->discount_amount = $request->discount_amount;
        $menuItem->save();

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Kedvezmény sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],
        ], 201);
    }

    public function updateName(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->name = $request->name;
        $menuItem->save();

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Név sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],

        ], 201);
    }

    public function getCategoriesWithItems()
    {
        $categories = Category::with('items')->get();
        return response()->json($categories);
    }

    public function updateDescription(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->description = $request->description;
        $menuItem->save();

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Leírás sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],
        ], 201);
    }

    public function updatePrice(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->price = $request->price;
        $menuItem->save();

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Ár sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],

        ], 201);
    }

    public function updateCategory(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->category_id = $request->category_id;
        $menuItem->save();

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Katgeória sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],

        ], 201);
    }

    public function updateComposition(UpdateMenuItemRequest $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        Composition::where('menu_item_id', $menuItem->id)->delete();

        foreach ($request->composition as $ingredientId) {
            Composition::create([
                'menu_item_id' => $menuItem->id,
                'ingredient_id' => $ingredientId,
            ]);
        }

        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');

        return response()->json([
            'message' => 'Összetétel sikeresen frissítve',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $compositionIds,
            ],
        ], 201);
    }

    public function updateImage(UpdateMenuItemRequest $request, $id)
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


        $menuItem->load('compositions');
        $compositionIds = $menuItem->compositions->pluck('ingredient_id');


        return response()->json(['message' => 'Kép sikersen frissítve', 'menuItem' => [
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'description' => $menuItem->description,
            'image_path' => $menuItem->image_path,
            'price' => $menuItem->price,
            'actual_price' => $menuItem->actual_price,
            'discount_amount' => $menuItem->discount_amount,
            'category_id' => $menuItem->category_id,
            'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
            'compositions' => $compositionIds,
        ],]);
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
            'message' => 'Étel sikeresen létrehozva',
            'menuItem' => [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
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

        return response()->json(['message' => 'Étel sikeresen törölve']);
    }

    public function popularItems()
    {
        $topSoldItems = MenuItem::join('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->select('menu_items.id', 'menu_items.name', 'menu_items.description', 'menu_items.price', 'discount_amount', 'menu_items.category_id', 'menu_items.image_path', DB::raw('COUNT(order_items.menu_item_id) as total_quantity'))
            ->groupBy('menu_items.id', 'menu_items.name', 'menu_items.description', 'menu_items.price', 'discount_amount', 'menu_items.category_id', 'menu_items.image_path')
            ->orderBy('total_quantity', 'desc')
            ->take(10)
            ->get();

        if ($topSoldItems->count() < 10) {
            $additionalItems = MenuItem::whereNotIn('id', $topSoldItems->pluck('id'))
                ->take(10 - $topSoldItems->count())
                ->get();

            $topSoldItems = $topSoldItems->merge($additionalItems);
        }

        $topSoldItems->load('category', 'compositions.ingredient');

        $formattedItems = $topSoldItems->map(function ($menuItem) {
            return [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
                'image_path' => $menuItem->image_path,
                'price' => $menuItem->price,
                'actual_price' => $menuItem->actual_price,
                'discount_amount' => $menuItem->discount_amount,
                'category_id' => $menuItem->category_id,
                'category_name' => $menuItem->category_id ? $menuItem->category->name : null,
                'compositions' => $menuItem->compositions->map(function ($composition) {
                    return [
                        'ingredient_id' => $composition->ingredient_id,
                        'ingredient_name' => $composition->ingredient->name,
                        'quantity' => 1
                    ];
                })->toArray(),
            ];
        });

        return response()->json($formattedItems, 200);
    }

    public function numberOfItemsInACategory($id)
    {
        return MenuItem::where('category_id', $id)->count();
    }
}
