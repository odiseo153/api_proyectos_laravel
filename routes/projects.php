<?php

use App\Project\Adapters\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::get('projects/{id}/members', [ProjectController::class,'members']);
    Route::post('projects/group/{id}', [ProjectController::class,'toggle']);
});






