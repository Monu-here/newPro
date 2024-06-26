<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LedgerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PartiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Define login route
Route::match(['GET', 'POST'], 'logintoken', [LoginController::class, 'login'])->name('login');
Route::match(['GET', 'POST'], 'logouttoken', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    // Item routes
    Route::prefix('item')->group(function () {
        Route::match(['GET', 'POST'], 'list', [ItemController::class, 'list']);
        Route::match(['GET', 'POST'], 'add', [ItemController::class, 'add']);
        Route::match(['GET', 'POST'], 'edit', [ItemController::class, 'edit']);
        Route::match(['GET', 'POST'], 'show', [ItemController::class, 'show']);
        Route::match(['GET', 'POST'], 'del', [ItemController::class, 'del']);
    });


    // Parties routes
    Route::prefix('parties')->group(function () {
        Route::match(['GET', 'POST'], 'list', [PartiesController::class, 'list']);
        Route::match(['GET', 'POST'], 'add', [PartiesController::class, 'add'])->name('parties.add');
        Route::match(['GET', 'POST'], 'edit', [PartiesController::class, 'edit'])->name('parties.edit');
        Route::match(['GET', 'POST'], 'show', [PartiesController::class, 'show'])->name('parties.show');
        Route::match(['GET', 'POST'], 'del', [PartiesController::class, 'del'])->name('parties.del');
    });
    Route::prefix('ledger')->group(function () {
        Route::match(['GET', 'POST'], 'list', [LedgerController::class, 'list']);
        Route::match(['GET', 'POST'], 'add', [LedgerController::class, 'add']);
        Route::match(['GET', 'POST'], 'edit', [LedgerController::class, 'edit']);
        Route::match(['GET', 'POST'], 'show', [LedgerController::class, 'show']);
        Route::match(['GET', 'POST'], 'del', [LedgerController::class, 'del']);
    });
});
