<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ErrorController;
use App\Http\Middleware\Authenticate;

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

Route::get('/',[AuthController::class, 'index'])->name('index');

Route::post('/',[AuthController::class, 'login'])->name('user.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('user.logout');

Route::get('/register',[RegisterController::class, 'index']);

Route::post('/register',[RegisterController::class, 'register'])->name('user.register');

Route::get('/403', [ErrorController::class, 'forbidden'])->name('error.403');

Route::group(['middleware' => ['token']], function() {
    Route::get('/banner', [BannerController::class, 'index']);

    Route::get('/artikel', function () {
        return view('artikel', [
            "title" => "artikel"
        ]);
    });

    Route::get('/travelling', function () {
        return view('travelling', [
            "title" => "travelling"
        ]);
    });

});



