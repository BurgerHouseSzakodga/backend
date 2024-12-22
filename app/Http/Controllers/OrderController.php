<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
}
