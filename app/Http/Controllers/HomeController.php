<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function studenci()
    {
        $user = Auth::user();
        $users = User::with('roles')
    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->where('roles.name', '!=', 'nauczyciel')
    ->select('users.id', 'users.name', 'users.email', 'users.class')
    ->get();
        return view('studenci', ['users' => $users])->with('user', $user);
    }
    public function addUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'class' => $request->class,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('student');

        return redirect()->back()->with('success', 'Użytkownik został dodany.');
    }
    public function delete ($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response('Usunięto', 200);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->class = $request->input('class');
        $user->save();

        return response('Zaktualizowano użytkownika', 200);
    }
    public function updateData(Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->class = $request->input('class');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response('Zaktualizowano użytkownika', 200);
    }
}
