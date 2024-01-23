<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [PageController::class, 'index'])->name('home');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/add/{qt}', [PageController::class, 'add']);
Route::delete('/quotes/{quote}', [PageController::class, 'destroy'])->name('quotes.destroy');



