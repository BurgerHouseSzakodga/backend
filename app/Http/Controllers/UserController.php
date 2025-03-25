<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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


    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'], // A "confirmed" mező ellenőrzi, hogy a két jelszó egyezik-e
        ], [
            'current_password.required' => 'A jelenlegi jelszó megadása kötelező.',
            'current_password.current_password' => 'A jelenlegi jelszó helytelen.',
            'new_password.required' => 'Az új jelszó megadása kötelező.',
            'new_password.min' => 'Az új jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'new_password.confirmed' => 'Az új jelszavak nem egyeznek.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return response()->json(['message' => 'Jelszó sikeresen módosítva'], 200);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:users,email,' . $request->user()->id
            ],
            'zip' => ['required', 'regex:/^\d{4}$/'],
            'city' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ\s]+$/u'],
            'street' => ['required', 'string', 'max:50'],
            'num' => ['required', 'regex:/^\d+$/'],
        ], [
            'name.required' => 'A név megadása kötelező.',
            'email.required' => 'Az email cím megadása kötelező.',
            'zip.required' => 'Az irányítószám megadása kötelező.',
            'city.required' => 'A város megadása kötelező.',
            'street.required' => 'Az utca megadása kötelező.',
            'num.required' => 'A házszám megadása kötelező.',
        ]);

        // Ellenőrizzük, hogy az "utca" szó már szerepel-e a címben
        $street = $validated['street'];
        if (!str_contains(strtolower($street), 'utca')) {
            $street .= ' utca';
        }

        $updatedAddress = "{$validated['zip']}, {$validated['city']}, {$street}, {$validated['num']}";

        $user = $request->user();
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $updatedAddress,
        ]);

        return response()->json($user, 200);
    }

    public function updateFullAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'address.max' => 'Az cím nem lehet hosszabb 255 karakternél.',
        ]);

        $user = Auth::user();
        $user->update(['address' => $validated['address']]);

        return response()->json([
            'message' => $validated['address'] ? 'Cím sikeresen frissítve' : 'Cím törölve',
            'address' => $validated['address'],
        ]);
    }
}
