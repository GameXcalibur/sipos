<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::post('/loginsil', [App\Http\Controllers\HomeController::class, 'login2'])->name('login.2');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/hubs', 'HomeController@hubs')
        ->name('hubs');

        Route::get('/reports', 'HomeController@reports')
        ->name('reports');

    Route::get('/settings/set', 'HomeController@settings')
        ->name('settings.set');

    Route::get('/devices/list', 'HomeController@devices')
        ->name('devices.list');

        Route::get('/networkstatus/list', 'HomeController@networkstatus')
        ->name('network.list');


    Route::post('/devices', [App\Http\Controllers\HomeController::class, 'getDevices'])->name('devices.get')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/hub/get', [App\Http\Controllers\HomeController::class, 'getHubInfo'])->name('hub.get')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/hub/schedule/get', [App\Http\Controllers\HomeController::class, 'getSchedule'])->name('hub.get.schedule')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/hub/device/delete', [App\Http\Controllers\HomeController::class, 'deleteDevice'])->name('hub.delete.device')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


    Route::post('/hub/init', [App\Http\Controllers\HomeController::class, 'hubOverviewInit'])->name('hub.init')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

        Route::get('/current-month/test-data', 'HomeController@testChart')
        ->name('current-month.test');
        Route::get('/current-month/test-dataw', 'HomeController@testChartw')
        ->name('current-month.testw');
        Route::get('/current-month/test-datam', 'HomeController@testChartm')
        ->name('current-month.testm');

        Route::get('/current-month/test-databi', 'HomeController@testChartbi')
        ->name('current-month.testbi');

        Route::get('/current-month/test-dataan', 'HomeController@testChartan')
        ->name('current-month.testan');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');
});

