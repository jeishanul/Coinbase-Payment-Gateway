<?php

use App\Http\Controllers\CoinPayController;
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
Route::post('/process', [CoinPayController::class, 'process'])->name('payment.process');
Route::get('/completed', [CoinPayController::class, 'completed'])->name('payment.completed');
Route::get('/canceled', [CoinPayController::class, 'canceled'])->name('payment.canceled');