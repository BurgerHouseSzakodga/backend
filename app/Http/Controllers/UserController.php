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

    //ez modositja az adatokat amit frontendről elküldtem
    public function userDataUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
        $user->save();
        
        return response()->json(['user' => $user], 200);
    }
}
