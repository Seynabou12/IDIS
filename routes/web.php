<?php

use App\Http\Controllers\CaptivePortalsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\NodeController;
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

// Route::get('/customer/{$customer_id}/networks', [NetworkController::class, 'index']);
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/selected-customer/{id}', [CustomerController::class, 'selected']);
Route::get('/networks', [NetworkController::class, 'index']);
Route::get('/pointacces', [NodeController::class, 'index']);
Route::get('/portail_captifs', [CaptivePortalsController::class, 'index']);
