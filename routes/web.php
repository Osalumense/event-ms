<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [PageController::class, 'index']);

Route::group(['middleware' => ['admin-auth']], function () {
    Route::get('/home', [PageController::class, 'renderHomePage']);
    Route::get('/dashboard', [PageController::class, 'renderOrganizerDashboard']);
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [PageController::class, 'renderEventDashboard']);
        Route::post('/', [PageController::class, 'saveEventDetails']);
    });
    
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['super-admin-auth']], function () {
        Route::get('/', [HomeController::class, 'Adminindex']);
        Route::get('/users/fetch', [HomeController::class, 'displayCounsellors']);
        Route::get('/users', [HomeController::class, 'renderCounsellorsPage']);
        Route::get('/vehicles', [HomeController::class, 'renderVehiclesViewPage']);
        // Route::get('/users/fetch', [HomeController::class, 'displayUsers']);
        Route::get('/users/edit/{id}', [HomeController::class, 'editUsers']);
        // Route::get('/user/edit/{id}', [HomeController::class, 'editCounsellor']);
        Route::post('/users/update', [HomeController::class,'updateCounsellors']);
        Route::post('/users/delete/{id}', [HomeController::class, 'deleteCounsellor']);
        Route::get('/users/add', [HomeController::class, 'renderNewUserPage']);
        Route::post('/users/add', [HomeController::class, 'createNewUser']);
        
        // Route::post('/user/delete/{id}', [HomeController::class, 'deleteCounsellor']);       
    });
});

Auth::routes();

