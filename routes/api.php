<?php

use App\Http\Controllers\Api\LeadController as ApiLeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('lead', ApiLeadController::class);
});
