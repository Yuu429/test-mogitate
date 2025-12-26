<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});
Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'products']);
    Route::get('register', [ProductController::class, 'register'])->name('product.register');
    Route::post('register', [ProductController::class, 'store'])->name('register.create');
    Route::get('search', [ProductController::class, 'search']);
    Route::get('{productId}', [ProductController::class, 'show'])->name('product.show');
    Route::patch('edit', [ProductController::class, 'edit'])->name('product.patch');
    Route::delete('destroy{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});
