<?php

use App\Http\Controllers\ProfileController;
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


Route::redirect('/', 'loan')->name('dashboard');



Route::group(
    [
        'middleware' => 'auth',
        'prefix'=>'loan',
        'as'=>'loan.'
    ],
    function () {

        Route::get('', [\App\Http\Controllers\LoanController::class,'index'])->name('index');
        Route::get('{loan}/show',  [\App\Http\Controllers\LoanController::class,'show'])->name('show');

        Route::get('/calculator', [\App\Http\Controllers\LoanController::class,'create'])->name('calculator');

        Route::post('/calculator', [\App\Http\Controllers\LoanController::class,'store'])
            ->name('calculator')
            ->middleware('transaction');

    }
);

require __DIR__ . '/auth.php';
