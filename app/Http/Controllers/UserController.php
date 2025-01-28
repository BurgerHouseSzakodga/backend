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

        return response()->json(['message' => 'User deleted successfully'], 200);
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

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    //ez modositja az adatokat amit frontendről elküldtem
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'address'));

        return response()->json(['message' => 'Profil sikeresen frissítve!']);
    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'A jelenlegi jelszó helytelen!'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Jelszó sikeresen módosítva!']);
    }

}
