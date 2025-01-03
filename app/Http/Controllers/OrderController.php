<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        return Order::where('status', '!=', 'átvéve')->count();
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
}
