<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Felhasználó sikeresen törölve'], 200);
    }

    public function numberOfUsers()
    {
        $user = Auth::user();
        return User::where('id', '!=', $user->id)->count();
    }

    public function updateIsAdmin(Request $request, $id)
    {
        $request->validate([
            'is_admin' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->is_admin = $request->input('is_admin');
        $user->save();

        return response()->json(['message' => 'Felhasználó sikeresen frissítve', 'user' => $user], 200);
    }
}