<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\MaidController;
use App\Http\Controllers\MaidRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MaidController::class, 'create'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/register', [UserController::class, 'store']);

Route::group(["prefix" => "admin", "middleware" => ["auth", "adminCheck"], "as" => "admin."], function () {
    Route::resource('/', MaidController::class)->only('index', 'store');
    Route::get('/maids/delete/{maid}', [MaidController::class, 'destroy']);
    Route::get('/requests', [MaidRequestController::class, 'index']);
    Route::get('/pending', [MaidRequestController::class, 'pending']);
    Route::get('/approved', [MaidRequestController::class, 'approved']);
    Route::get('/request/approve/{maidRequest}', [MaidRequestController::class, 'approve']);
    Route::get('/request/reject/{maidRequest}', [MaidRequestController::class, 'destroy']);
    Route::get('/settings', [UserController::class, 'create']);
    Route::put('/settings', [UserController::class, 'update']);
    Route::resource('/contracts', ContractController::class)->only('index');
});

Route::group(["prefix" => "employer", "middleware" => ["auth", "employerCheck"], "as" => "employer."], function () {
    Route::get('/', [MaidController::class, 'employerList']);
    Route::post('/', [MaidRequestController::class, 'store']);
    Route::get('/requests', [MaidRequestController::class, 'employerList']);
    Route::get('/settings', [UserController::class, 'create']);
    Route::put('/settings', [UserController::class, 'update']);
    Route::resource('/contracts', ContractController::class)->only('index', 'store');
    Route::get('/contract/{id}', [ContractController::class, 'paper']);
    Route::post('/contract', [ContractController::class, 'signed']);
});
