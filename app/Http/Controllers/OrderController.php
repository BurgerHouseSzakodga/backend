<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.menuItem'])->get();

        return $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_name' => $order->user->name,
                'delivery_address' => $order->delivery_address,
                'total' => $order->total,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'items' => $order->orderItems->map(function ($orderItem) {
                    return [
                        'name' => $orderItem->menuItem->name,
                        'quantity' => $orderItem->menu_item_quantity,
                    ];
                }),
            ];
        });
    }

    public function numberOfOrders()
    {
        return Order::all()->count();
    }

    public function totalRevenue()
    {
        return Order::sum('total');
    }

    public function pendingOrders()
    {
        return Order::where('status', '!=', 'kiszállítva')->count();
    }

    public function revenueByDays($days)
    {
        $startDate = Carbon::now()->subDays($days)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $dates = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total) as revenue')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('revenue', 'date')
            ->toArray();

        foreach ($revenues as $date => $revenue) {
            $dates[$date] = $revenue;
        }

        return [
            array_values($dates),
        ];
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:készül,kiszállítva',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        $order->load(['user', 'orderItems.menuItem']);

        $formattedOrder = [
            'id' => $order->id,
            'user_name' => $order->user->name,
            'delivery_address' => $order->delivery_address,
            'total' => $order->total,
            'status' => $order->status,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
            'items' => $order->orderItems->map(function ($orderItem) {
                return [
                    'name' => $orderItem->menuItem->name,
                    'quantity' => $orderItem->menu_item_quantity,
                ];
            }),
        ];

        return response()->json(['message' => 'Sikeres módosítás', 'order' => $formattedOrder]);
    }

    public function userOrders($id){
        $user=Auth::user();
        $orders = Order::where('user_id',$id)->with(['user', 'orderItems.menuItem'])->get();
        return $orders;
    }
}
