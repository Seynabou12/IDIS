<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/reporting', function () {
    return view('pages.reporting');
});

Route::get('/location', function () {
    return view('pages.locations');
});

Route::get('/pointAccés', function () {
    return view('pages.pointacces');
});
// Route::get('/mentors/create', [MentorController::class, 'create']);
// Route::post("/mentors/create", [MentorController::class, 'store']);
