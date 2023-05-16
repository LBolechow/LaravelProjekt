<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function updateData(Request $request, $id)
{
    $user = User::findOrFail($id);

    if (!$user) {
        return response('Użytkownik nie został znaleziony', 404);
    }
    $user->name = $request->input('name');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return response('Zaktualizowano użytkownika', 200);
}
}
