<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;
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
    return view('welcome');
});

Route::prefix('apiusers')->group(function () {
    Route::get('/', [ApiUserController::class, 'jsonIndex']);
    Route::get('/xml', [ApiUserController::class, 'xmlIndex']);
});
