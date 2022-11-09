<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptivePortalsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\OrganitUnitController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VoucherController;
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

Route::get('/customer/{$customer_id}/networks', [NetworkController::class, 'index']);
Route::get("/login", [AuthController::class, 'formLogin'])->name('auth.formLogin');
Route::post("/login", [AuthController::class, 'login'])->name('auth.login');
Route::get("/accueil", [AccueilController::class, 'accueil'])->name('accueil');
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/groups', [GroupController::class, 'index']);
Route::get('/reporting', function () {
    return view('pages.reporting');
});

Route::get('/users', [UtilisateurController::class, 'index']);
Route::get('/users/details', [UtilisateurController::class, 'details']);
Route::get('/networks', [NetworkController::class, 'index']);
Route::post('/networks/add', [NetworkController::class, 'store']);
Route::get('/networks/add', [NetworkController::class, 'create']);
Route::get("/networks/{id}/delete", [NetworkController::class, 'delete'])->name("network.delete")->where('id', '[0-9a-z\-]+');
Route::get('/pointacces', [NodeController::class, 'index']);
Route::get('/portail_captifs', [CaptivePortalsController::class, 'index']);
Route::get('/orgunits', [OrganitUnitController::class, 'index']);
Route::get('/vouchers', [VoucherController::class, 'index']);



Route::get('/selected-customer/{id}', [CustomerController::class, 'selected']);



Route::middleware(['authentification'])->group(
    function () {
    }
);