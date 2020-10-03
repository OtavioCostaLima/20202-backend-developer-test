<?php

use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurvivorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1')->group(function () {
    Route::get('/survivors', [SurvivorController::class, 'index']);
    Route::post('/survivors', [SurvivorController::class, 'store']);
    Route::put('/survivors/{survivor_id}', [SurvivorController::class, 'update']);
    Route::post('/survivors/{survivor_id}/infected', [SurvivorController::class, 'notifyInfected']);
    
    Route::get('/reports/survivors', [ReportController::class, 'percentageSurvivors']);
    Route::get('/reports/resources', [ReportController::class, 'resourceAverage']);
    Route::get('/reports/points/pointsLost', [ReportController::class, 'lostPoints']);
    


});

