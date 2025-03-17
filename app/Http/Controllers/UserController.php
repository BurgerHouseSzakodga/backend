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

    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:30'],
        ]);

        $user = Auth::user();
        $user->update(['name' => $validated['name']]);

        return response()->json(['message' => 'Név sikeresen frissítve']);
    }

    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:users,email,' . auth()->id()
            ],
        ], [
            'email.regex' => 'Az email címnek tartalmaznia kell @ jelet és érvényes formátumúnak kell lennie.',
            'email.email' => 'Érvénytelen email formátum.'
        ]);

        $user = Auth::user();
        $user->update(['email' => $validated['email']]);

        return response()->json(['message' => 'Email sikeresen frissítve']);
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'zip' => [
                'required',
                'string',
                'size:4',
                'regex:/^[0-9]{4}$/'
            ],
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'num' => ['required', 'string', 'max:10']
        ], [
            'zip.size' => 'Az irányítószámnak pontosan 4 számjegyből kell állnia.',
            'zip.regex' => 'Az irányítószám csak számokat tartalmazhat.'
        ]);

        $user = Auth::user();
        $fullAddress = "{$validated['zip']}, {$validated['city']}, {$validated['street']}, {$validated['num']}";

        $user->update(['address' => $fullAddress]);

        return response()->json(['message' => 'Cím sikeresen frissítve']);
    }

    public function updateFullAddress(Request $request)
    {
        $user = Auth::user();

        $user->update(['address' => $request->address]);

        return response()->json(['message' => 'Cím sikeresen frissítve']);
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'min:8', 'confirmed'],
                'new_password_confirmation' => ['required']
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            if (isset($errors['current_password'])) {
                return response()->json(['message' => 'A jelenlegi jelszó helytelen.'], 422);
            }
            return response()->json(['message' => 'Hiba történt a jelszó módosítása során.'], 422);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Jelszó sikeresen módosítva'
        ]);
    }
}
