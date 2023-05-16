<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Models\User;
use App\Models\Tests;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/wykonywanie/{id}', 'App\Http\Controllers\TestController@start')->middleware('role:student')->name('testy.start');
Route::post('/testy/{id}/submit', 'App\Http\Controllers\TestController@submit')->middleware('role:student')->name('testy.submit');
Route::get('/studenci', 'App\Http\Controllers\HomeController@studenci')->middleware('role:nauczyciel')->name('studenci');
Route::post('/studenci', [App\Http\Controllers\HomeController::class, 'addUser'])->middleware('role:nauczyciel')->name('home.addUser');
Route::delete('/studenci/{id}','App\Http\Controllers\HomeController@delete')->middleware('role:nauczyciel')->name('home.delete');
Route::put('/studenci/{id}', 'App\Http\Controllers\HomeController@update')->middleware('role:nauczyciel')->name('home.update');
Route::put('/profil/{id}', 'App\Http\Controllers\UserController@updateData')->name('profil.updateData');
Route::get('/pytania', 'App\Http\Controllers\PytanieController@pytania')->middleware('role:nauczyciel')->name('pytania');
Route::post('/pytania', 'App\Http\Controllers\PytanieController@add')->middleware('role:nauczyciel')->name('pytania.add');
Route::put('/pytania/{id}', 'App\Http\Controllers\PytanieController@update')->middleware('role:nauczyciel')->name('pytania.update');
Route::delete('/pytania/{id}', 'App\Http\Controllers\PytanieController@delete')->middleware('role:nauczyciel')->name('pytania.delete');
Route::get('/testy', 'App\Http\Controllers\TestController@testy')->middleware('role:nauczyciel')->name('testy');
Route::post('/testy/create', 'App\Http\Controllers\TestController@store')->middleware('role:nauczyciel')->name('testy.store');
Route::get('/tests', 'App\Http\Controllers\TestController@index')->middleware('role:nauczyciel')->name('testy.index');
Route::get('/userTests', 'App\Http\Controllers\TestController@showUserTests')->middleware('role:student')->name('testy.showUserTests');
Route::get('/tests/{test}', [App\Http\Controllers\TestController::class, 'show'])->middleware('role:nauczyciel')->name('testy.show');
Route::get('/testsUsers/{test}', [App\Http\Controllers\TestController::class, 'showUsers'])->middleware('role:nauczyciel')->name('testy.showUsers');
Route::put('/tests/{test}', [App\Http\Controllers\TestController::class, 'update'])->middleware('role:nauczyciel')->name('testy.update');
Route::delete('/tests/{test}', [App\Http\Controllers\TestController::class, 'deleteTest'])->middleware('role:nauczyciel')->name('testy.deleteTest');
Route::get('/wyniki', [App\Http\Controllers\TestController::class, 'showResults'])->middleware('role:student')->name('testy.showResults');
Route::get('/wynikiStudentow', [App\Http\Controllers\TestController::class, 'showStudentsResults'])->middleware('role:nauczyciel')->name('testy.showStudentsResults');


Route::get('/profil', function () {
    return view('profil');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

