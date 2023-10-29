<?php

use App\Http\Controllers\CoinBaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::post('/process', [CoinBaseController::class, 'process'])->name('payment.process');
Route::get('/completed', [CoinBaseController::class, 'completed'])->name('payment.completed');
Route::get('/canceled', [CoinBaseController::class, 'canceled'])->name('payment.canceled');