<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

    Route::get('/people', function () {
        return view('pages.people', [
            "active" => "home",
        ]);
    });

    Route::get('/movies', function () {
        return view(
            'pages.movies',
            [
                "active" => "movies",
            ]
        );
    });

    Route::get('/tvshow', function () {
        return view(
            'pages.tvshow',
            [
                "active" => "home",
            ]
        );
    });
});
