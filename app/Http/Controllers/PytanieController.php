<?php

namespace App\Http\Controllers;

use App\Models\Pytanie;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PytanieController extends Controller
{
    public function pytania()
    {
        $user = Auth::user();
        $pytania = Pytanie::all();
        return view('pytania', ['pytania' => $pytania])->with('user', $user);
    }

    public function add(Request $request)
    {

        $question = Pytanie::create([
            'pytanie' => $request->pytanie,
            'odp1' =>$request->odp1,
            'odp2' =>$request->odp2,
            'odp3' =>$request->odp3,
            'odp4' =>$request->odp4,
            'dobra_odpowiedz' =>$request->dobra_odpowiedz,
        ]);


        return redirect()->back()->with('success', 'Dodano pytanie.');
    }
  
    public function update(Request $request, $id)
    {
        $question = Pytanie::findOrFail($id);
        $question->pytanie = $request->input('pytanie');
        $question->odp1 = $request->input('odp1');
        $question->odp2 = $request->input('odp2');
        $question->odp3 = $request->input('odp3');
        $question->odp4 = $request->input('odp4');
        $question->dobra_odpowiedz = $request->input('dobra_odpowiedz');
        $question->save();

        return response('Zaktualizowano pytanie.', 200);
    }

    public function delete ($id)
    {
        $question = Pytanie::findOrFail($id);
        $question->delete();

        return response('Usunięto pytanie.', 200);
    }
}