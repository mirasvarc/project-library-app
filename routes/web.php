<?php

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
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('users')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::post('/{user}/edit', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/get/all', [App\Http\Controllers\UserController::class, 'getAllUsers'])->name('users.all');
    Route::get('/{user}/approve', [App\Http\Controllers\UserController::class, 'approveUser'])->name('users.approve');
    Route::get('/{user}/block', [App\Http\Controllers\UserController::class, 'blockUser'])->name('users.block');
});

Route::prefix('library')->middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('books');
    Route::get('/create', [App\Http\Controllers\BookController::class, 'create'])->name('books.create');
    Route::post('/create', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');
    Route::get('/{id}', [App\Http\Controllers\BookController::class, 'show'])->name('books.show');
    Route::get('/{id}/edit', [App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
    Route::post('/{id}/edit', [App\Http\Controllers\BookController::class, 'update'])->name('books.update');
    Route::get('/{id}/delete', [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/get/all', [App\Http\Controllers\BookController::class, 'getAllBooks'])->name('books.all');
});

Route::prefix('book')->middleware('auth')->group(function() {
    Route::get('/{id}/borrow', [App\Http\Controllers\BookController::class, 'borrowBook'])->name('books.borrow');
    Route::get('/{id}/return', [App\Http\Controllers\BookController::class, 'returnBook'])->name('books.return');
    Route::get('/{id}/borrowfor/{user}', [App\Http\Controllers\BookController::class, 'borrowBookForUser'])->name('books.borrowfor');
});

Route::prefix('my-library')->middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\UserController::class, 'showMyLibrary'])->name('show-my-library');
});

Route::get('exportData', [App\Http\Controllers\Controller::class, 'exportData']);
Route::get('importData', [App\Http\Controllers\Controller::class, 'importData']);


require __DIR__.'/auth.php';
