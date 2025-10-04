<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorDataController;

Route::get('/sensor/latest', [SensorDataController::class, 'latest']);
Route::get('/sensor/range', [SensorDataController::class, 'range']);