<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Domain\Task\Controllers\TaskController;

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::apiResource('tasks', TaskController::class)->only(['store', 'destroy']);
    Route::apiResource('tasks', TaskController::class)->except(['store', 'destroy'])->withoutMiddleware(AdminMiddleware::class);
});

