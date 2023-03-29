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
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   // Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
   Route::controller(ProductController::class)->group(function(){
        Route::get('products', 'index')->name('products.index');
        Route::post('products', 'store')->name('products.store');
        Route::get('products/create', 'create')->name('products.create');
        Route::get('products/{product}', 'show')->name('products.show');
        Route::put('products/{product}', 'update')->name('products.update');
        Route::delete('products/{product}', 'destroy')->name('products.destroy');
        Route::get('products/{product}/edit', 'edit')->name('products.edit');
    });
});
Route::post('/upload', [UploadController::class, 'store'])->name('upload');