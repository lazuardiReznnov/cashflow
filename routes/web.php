<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\ReportController;
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

Route::controller(ReportController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(AcountController::class)->group(function () {
    route::get('/cash/acount/checkSlug', 'checkSlug');
});

Route::resource('/cash/acount', AcountController::class);

Route::controller(CashController::class)->group(function () {
    Route::get('/cash', 'index');
    Route::get('/cash/create', 'create');
    Route::get('/cash/create-in', 'createin');
    Route::get('/cash/create-out', 'createout');

    Route::post('/cash/', 'store');
    Route::get('/cash/{cashflow}/edit', 'edit');
    Route::put('/cash/{cashflow}', 'update');
    Route::delete('/cash/{cashflow}', 'destroy');
});
