<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('dashboard', [HomeController::class,'index'])->name('admin.index');

    Route::get('/products', [ProductController::class,'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
    Route::post('/products/save', [ProductController::class,'save'])->name('products.save');
    Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('products.edit');
    Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}', [ProductController::class,'delete'])->name('products.delete');

    Route::get('/employee', [EmployeeController::class,'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class,'create'])->name('employee.create');
    Route::post('/employee/save', [EmployeeController::class,'save'])->name('employee.save');
    Route::get('/employee/edit/{id}', [EmployeeController::class,'edit'])->name('employee.edit');
    Route::put('/employee/edit/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/delete/{id}', [EmployeeController::class,'delete'])->name('employee.delete');

    Route::get('/category', [CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/category/save', [CategoryController::class,'save'])->name('category.save');
    Route::get('/category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
});

require __DIR__.'/auth.php';

