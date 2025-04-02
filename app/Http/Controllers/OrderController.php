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
        $orders = Order::with(['user', 'orderItems.menuItem', 'orderItems.extras.ingredients'])->get();

        return $orders;
    }

    public function numberOfOrders()
    {
        return Order::all()->count();
    }

    public function numberOfDeliveries()
    {
        return Order::where('delivery_address', '!=', null)->count();
    }

    public function numberOfCollects()
    {
        return Order::where('delivery_address', null)->count();
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

        return $this->index();
    }

    public function userOrders($id)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $id)->with(['user', 'orderItems.menuItem', 'orderItems.extras.ingredients'])->get();
        return $orders;
    }

    public function activeUserOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->where('status', 'készül')->get();
        return $orders;
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return $this->index();
    }
}
