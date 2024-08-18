<?php

use App\Http\Controllers\Api\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::apiResource('developers', DeveloperController::class)
            ->names([
                'index' => 'api.v1.developers.index',
                'show' => 'api.v1.developers.show',
                'store' => 'api.v1.developers.store',
                'update' => 'api.v1.developers.update',
                'destroy' => 'api.v1.developers.destroy',
            ]);
    });
});
