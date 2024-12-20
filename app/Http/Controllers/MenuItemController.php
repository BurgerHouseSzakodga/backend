<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    //get minden étel lekérése
    public function  index()
    {
        return MenuItem::all();
    }
}
