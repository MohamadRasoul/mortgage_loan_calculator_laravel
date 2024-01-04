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
        Route::view('/calculator', 'pages.calculators')->name('calculator');
        Route::view('/calculator/result', 'pages.result')->name('result');
    }
);

require __DIR__ . '/auth.php';
