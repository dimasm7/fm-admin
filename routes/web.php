<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('dashboard');
    // return view('welcome');
});

Route::prefix('dashboard')//agar urlnya selalu diawali dashboar
        ->middleware(['auth:sanctum', 'admin'])
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('users', UserController::class);
            Route::resource('food', FoodController::class);

            Route::get('transaction/{id}/status/{status}', [TransactionController::class, 'changeStatus'])->name('transactions.changeStatus');
            Route::resource('transactions', TransactionController::class);
        });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//midtrans related
Route::get('midtrans/success',[MidtransController::class,'success']);
Route::get('midtrans/unfinish',[MidtransController::class,'unfinish']);
Route::get('midtrans/error',[MidtransController::class,'error']);
