<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\TallyController;
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
    return view('welcome');
});


Route::get('/pdf', [PdfController::class, 'index'])->name('pdf');
Route::get('/opbill-pdf/{record}', [PdfController::class, 'opbill'])->name('op-invoice');
Route::get('/ipbill-pdf/{record}', [PdfController::class, 'ipbill'])->name('ip-invoice');
Route::get('/tally', [TallyController::class, 'index']);
