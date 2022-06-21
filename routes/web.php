<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ErrorController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\TravelController;

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
URL::forceScheme('https');
Route::get('/',[AuthController::class, 'index'])->name('index');

Route::post('/',[AuthController::class, 'login'])->name('user.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('user.logout');

Route::get('/register',[RegisterController::class, 'index']);

Route::post('/register',[RegisterController::class, 'register'])->name('user.register');

Route::get('/403', [ErrorController::class, 'forbidden'])->name('error.403');

Route::group(['middleware' => ['token']], function() {
    Route::get('/banner', [BannerController::class, 'index']);
    Route::post('/banner', [BannerController::class, 'postBanner'])->name('postBanner');
    Route::put('/banner', [BannerController::class, 'updateBanner'])->name('updateBanner');
    Route::delete('/banner', [BannerController::class, 'deleteBanner'])->name('deleteBanner');

    Route::get('/artikel', [RecomendationController::class, 'index']);
    Route::post('/artikel', [RecomendationController::class, 'postRecomendation'])->name('postArtikel');
    Route::put('/artikel', [RecomendationController::class, 'updateRecomendation'])->name('updateArtikel');
    Route::delete('/artikel', [RecomendationController::class, 'deleteRecomendation'])->name('deleteArtikel');

    Route::get('/travelling', [TravelController::class, 'index']);
    Route::post('/travelling', [TravelController::class, 'postTravel'])->name('postTravel');
    Route::put('/travelling', [TravelController::class, 'updateTravel'])->name('updateTravel');
    Route::delete('/travelling', [TravelController::class, 'deleteTravel'])->name('deleteTravel');

});



