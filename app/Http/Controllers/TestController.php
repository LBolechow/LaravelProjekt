<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Pytanie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        $pytania = Pytanie::all();
        $users = User::all();
        return view('show', compact('tests', 'pytania', 'users'));
    }
    public function showUserTests()
    {
        $user = Auth::user();

        $testsFromClass = Test::where('klasa', $user->class)
            ->whereNotExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('test_results')
                    ->whereColumn('test_results.test_id', 'tests.id')
                    ->where('test_results.user_id', $user->id);
            });
    
        $testsFromRelation = Test::whereHas('studenci', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
            ->whereNotExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('test_results')
                    ->whereColumn('test_results.test_id', 'tests.id')
                    ->where('test_results.user_id', $user->id);
            });
    
        $tests = $testsFromClass->union($testsFromRelation)->get();
    
        return view('wykonajtest', compact('tests'));
    }
   
   
    public function testy()
    {
        $pytania = Pytanie::all();
        $users = User::all();
        return view('create', ['pytania' => $pytania, 'users' => $users]);
    }

    public function show($id)
    {   
        $test = Test::findOrFail($id);
        $pytania = $test->pytania;
    
        return response()->json([
            'test' => $test,
            'pytania' => $pytania,
        ]);
    }
    public function showUsers($id)
    {   
        $test = Test::findOrFail($id);
        $users = $test->studenci;
    
        return response()->json([
            'test' => $test,
            'users' => $users,
        ]);
    }
  


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'klasa' => 'required',
            'pytania' => 'required|array',
            'pytania.*' => 'exists:pytania,id',
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);
    
        $test = Test::create([
            'title' => $validatedData['title'],
            'klasa' => $validatedData['klasa'],
        ]);
    
        $test->pytania()->attach($validatedData['pytania']);
        if (isset($validatedData['users']) && !empty($validatedData['users'])) {
            $test->studenci()->attach($validatedData['users']);
        }
    
        return redirect()->back()->with('success', 'Dodano test.');
    } 

public function deleteTest($id)
{
    $test = Test::findOrFail($id);
    $test->delete();

    return response('Usunięto pytanie.', 200);
}
    public function update(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $test->title = $request->input('title');
        $test->klasa = $request->input('klasa');
        $test->save();

        return response('Zaktualizowano pytanie.', 200);
    }


    public function start($id)
    {
        $test = Test::findOrFail($id);
        $pytania = $test->pytania->shuffle(); // Losowe pytania

        return view('nowy', compact('test', 'pytania'));
    }
 

    public function submit(Request $request, $id)
{
    $test = Test::findOrFail($id);
    
    $pytania = $test->pytania;
    $totalPoints = count($pytania);
    $score = 0;

    foreach ($pytania as $pytanie) {
        $userAnswer = $request->input('pytanie_' . $pytanie->id);
        if ($userAnswer === $pytanie->dobra_odpowiedz) {
            $score++;
        }
        else {
            // Jeżeli odpowiedź użytkownika jest błędna, dodaj wynik do tablicy wyników
            $results[] = [
                'pytanie' => $pytanie->pytanie,
                'userAnswer' => $userAnswer,
                'correctAnswer' => $pytanie->dobra_odpowiedz,
            ];
        }
    
    }
    DB::table('test_results')->insert([
        'user_id' => Auth::id(),
        'test_id' => $test->id,
        'wynik_procentowy' => $score / $totalPoints * 100,
    ]);
   
    Session::flash('results', $results);
    return redirect()->route('testy.showResults');
}
public function showResults()
{
    $userId = Auth::user()->id;

    $results = DB::table('test_results')
        ->join('users', 'test_results.user_id', '=', 'users.id')
        ->join('tests', 'test_results.test_id', '=', 'tests.id')
        ->select('test_results.id', 'users.name as user_name', 'tests.title as test_name', 'test_results.wynik_procentowy')
        ->where('test_results.user_id', $userId)
        ->get();
    
    return view('wyniki', compact('results'));
}

public function showStudentsResults()
{
    $results = DB::table('test_results')
    ->join('users', 'test_results.user_id', '=', 'users.id')
    ->join('tests', 'test_results.test_id', '=', 'tests.id')
    ->select('test_results.id', 'users.name as user_name', 'tests.title as test_name', 'test_results.wynik_procentowy')
    ->get();

return view('studenciwyniki', compact('results'));
}

 
}
