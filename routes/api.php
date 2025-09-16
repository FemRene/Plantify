<?php

use App\Http\Controllers\api\MeasurementsController;
use App\Http\Controllers\api\PlantController;
use App\Http\Controllers\api\RoomController;

Route::middleware('auth.basic')->apiResource('plants', PlantController::class);
Route::middleware('auth.basic')->apiResource('rooms', RoomController::class);
Route::middleware('auth.basic')->apiResource('measures', MeasurementsController::class);
