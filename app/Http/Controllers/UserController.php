<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function numberOfUsers()
    {
        return User::where('is_admin', '0')->count();
    }
}
