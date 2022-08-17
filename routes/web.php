<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\SensorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

/*Se necesita autentificaion para acceder a las diferentes vistas*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
        Route::get('/home', function () { return view('dash.welcome'); })->name('home');
        Route::get('/dash', function () { return view('dash.index'); })->name('dash');
        Route::get('/control', function () { return view('control.index');})->name('control');
        Route::get('/chart/index', function () { return view('chart.index'); })->name('chart/index');
        Route::get('/chart', [ChartController::class, 'basesT'])->name('chart');
        Route::get('/chart/hum', [SensorController::class, 'basesH'])->name('chart/hum');
        Route::get('/profile', function () { return view('profile.show'); })->name('profile');
        Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');
});

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
   Route::get('/control', function () {
        return view('control.index');
    })->name('control');
});
     */
/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
   Route::get('/chart', function () {
        return view('chart.index');
    })->name('chart');
}); */

/* Route::get('/chart', [ChartController::class, 'bases'])->name('chart'); */

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
        Route::get('/profile', function () {
            return view('profile.show');
        })->name('profile');
}); */

//Armar una ruta
/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
   
}); */  
/* 
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */  