<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ViolationController;
use Illuminate\Support\Facades\Route;

Route::apiResource('citizens', CitizenController::class);
Route::apiResource('citizens.licenses', LicenseController::class);
Route::apiResource('citizens.licenses.violations', ViolationController::class);
