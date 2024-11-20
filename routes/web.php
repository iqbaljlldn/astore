<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SaleItemsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
    })->name('dashboard');

    Route::resource('/sales', SalesController::class);
    Route::resource('/products', ProductsController::class);

    Route::get('/sales/{saleId}/item/create', [SaleItemsController::class, 'create'])->name('sale-item-create');
    Route::post('/sales/{saleId}/item', [SaleItemsController::class, 'store'])->name('sale-item-store');
    Route::get('/sales/{saleId}/item/{id}/edit', [SaleItemsController::class, 'edit'])->name('sale-item-edit');
    Route::put('/sales/{saleId}/item/{id}', [SaleItemsController::class, 'update'])->name('sale-item-update');
    Route::put('/sales/{saleId}/item/{id}/delete', [SaleItemsController::class, 'destroy'])->name('sale-item-delete');
});
