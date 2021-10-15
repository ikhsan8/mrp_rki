<?php

use App\Http\Controllers\oee\OeeDashboardController;
use App\Http\Controllers\Oee\OeeProductionPerformanceController;
use App\Http\Controllers\Oee\OeeSetController;
use App\Models\Oee\OeeMachine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('oee')->name('oee.')->group(
    function () {
        Route::post('/production-performance', [OeeProductionPerformanceController::class, 'daily'])->name('production-performance.daily');
        Route::post('/production-performance-detail', [OeeProductionPerformanceController::class, 'dailyDetailDefect'])->name('production-performance-detail.daily');
        Route::post('/production-performance-detail-effeciency', [OeeProductionPerformanceController::class, 'dailyDetailEffeciency'])->name('production-performance-detail-effeciency.daily');
        Route::post('/production-trend', [OeeDashboardController::class, 'productionTrend'])->name('production-trend');
    }
);

Route::get('/get-production/{id}', [OeeSetController::class, 'getProduction'])->name('api-get-production');
Route::get('/get-oee-machines', function(){
    return OeeMachine::orderBy('index')->with('oeeAlarmMaster.alarms')->with('oeeAlarmMaster.alarms')->get();
})->name('api-get-production');
// alarm trigger store
Route::post('/store-alarm', [OeeAlarmsController::class, 'storeAlarm'])->name('api-post-alarm');