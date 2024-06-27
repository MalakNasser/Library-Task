<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("library")->group(function () {
    Route::prefix("/book")->group(function () {
        Route::post('/borrow', [LibraryController::class, 'borrowBook']);
        Route::put('/return/{id}', [LibraryController::class, 'returnBook']);
    });
    Route::get('/report', [LibraryController::class, 'generateReport']);
});
