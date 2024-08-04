<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::get('/import',[ProductController::class,'importView'])->name('import-view');
Route::post('/import',[ProductController::class,'import'])->name('import');
Route::get('/export-products',[ProductController::class,'exportProduct'])->name('export-products');

Route::get('/', function () {
    return view('welcome');
});

