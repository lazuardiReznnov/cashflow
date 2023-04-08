<?php

use App\Http\Controllers\CashController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(CashController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/cash/create', 'create');
    Route::post('/cash/', 'store');
    Route::get('/cash/{cashflow}/edit', 'edit');
    Route::put('/cash/{cashflow}', 'update');
    Route::delete('/cash/{cashflow}', 'destroy');
});
