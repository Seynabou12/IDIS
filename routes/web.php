<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AdminDashbordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptivePortalsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\OrganitUnitController;
use App\Http\Controllers\ReportingContoller;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\Auth;
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

Route::get('/welcom', [AdminDashbordController::class, 'welcom']);

Route::get('/reporting', [ReportingContoller::class, 'reporting']);

Route::get('/dashbord', [SuperAdminController::class, 'dashbord'])->name('dashbord');

Route::get('/customer/{$customer_id}/networks', [NetworkController::class, 'index']);
Route::get('/selected-customer/{id}', [CustomerController::class, 'selected']);
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}/details', [CustomerController::class, 'details'])->where('id', '[0-9]+');
Route::post('/customers/create', [CustomerController::class, 'create'])->where("id", "[0-9a-z]+");
Route::get('/customers/{id}/delete', [CustomerController::class, 'delete'])->name("customer.delete")->where('id', '[0-9a-z\-]+');

Route::get("/", [AuthController::class, 'formLogin'])->name('auth.formLogin');
Route::post("/", [AuthController::class, 'login'])->name('auth.login');

Route::get("/accueil", [AccueilController::class, 'accueil'])->name('accueil');
    
Route::get('/groups', [GroupController::class, 'index'])->where('id', '[0-9a-z\-]+');
Route::post('/groups/create', [GroupController::class, 'create']);
Route::get('/groups/{id}/delete', [GroupController::class, 'delete'])->name("group.delete")->where('id', '[0-9a-z\-]+');

Route::get('/users', [UtilisateurController::class, 'index'])->where('id', '[0-9a-z\-]+');
Route::get('/users/{id}/details', [UtilisateurController::class, 'details'])->name('user.details')->where("id", "[0-9a-z]+");
Route::get('/users/{id}/delete', [UtilisateurController::class, 'delete'])->name("user.delete")->where('id', '[0-9a-z\-]+');

Route::get('/guests', [GuestController::class, 'index'])->where('id', '[0-9a-z\-]+');
Route::get('/guests/{id}/details', [GuestController::class, 'details'])->where("id", "[0-9a-z]+");
// Route::get('/guests/{id}/delete', [UtilisateurController::class, 'delete'])->name("user.delete")->where('id', '[0-9a-z\-]+');

Route::get('/networks', [NetworkController::class, 'index'])->where('id', '[0-9a-z\-]+');
Route::post('/networks/add', [NetworkController::class, 'store'])->where("id", "[0-9a-z]+");
Route::get('/networks/{id}/delete', [NetworkController::class, 'delete'])->name("network.delete")->where('id', '[0-9a-z\-]+');

Route::get('/pointacces', [NodeController::class, 'index'])->where('id', '[0-9a-z\-]+');

Route::get('/portail_captifs', [CaptivePortalsController::class, 'index'])->where('id', '[0-9a-z\-]+');
Route::post('/portail_captifs/create', [CaptivePortalsController::class, 'create'])->name('portail_captifs')->where('id', '[0-9a-z\-]+');
Route::get("/portail_captifs/{id}/delete", [CaptivePortalsController::class, 'delete'])->name("portail_captifs.delete")->where('id', '[0-9a-z\-]+');

Route::get('/orgunits', [OrganitUnitController::class, 'index'])->where('id', '[0-9a-z\-]+');

Route::get('/vouchers', [VoucherController::class, 'index'])->where('id', '[0-9a-z\-]+');









