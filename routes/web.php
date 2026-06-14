<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;

Route::get('/', [RentController::class, 'index']);

Route::get('/form', [RentController::class, 'create']);

Route::post('/generate-receipt', [RentController::class, 'store']);

Route::get('/receipt/{id}', [RentController::class, 'show']);

Route::get('/tenants', [RentController::class, 'tenantIndex']);

Route::post('/tenants', [RentController::class, 'tenantStore']);

Route::get('/profile', [RentController::class, 'profileEdit']);

Route::post('/profile', [RentController::class, 'profileUpdate']);