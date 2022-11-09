<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TvShowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/about', function () {
        return view('pages.about', [
            "active" => "about",
        ]);
    });

    Route::get('/people', [PeopleController::class, 'index']);
    Route::get('people/{id}', [PeopleController::class, 'show']);

    Route::get('/movies', [MovieController::class, 'index']);
    Route::get('/movies/{id}', [MovieController::class, 'show']);

    Route::get('/tvshow', [TvShowController::class, 'index']);
    Route::get('/tvshow/{id}', [TvShowController::class, 'show']);
});
