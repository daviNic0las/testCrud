<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpreadsheetController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'student' => StudentController::class,
        'category' => CategoryController::class,
    ]);

    // Adicione estas rotas para o SpreadsheetController
    Route::post('/spreadsheet/create', [SpreadsheetController::class, 'create'])->name('spreadsheet.create');
    Route::get('/spreadsheet/read/{filename}', [SpreadsheetController::class, 'read'])->name('spreadsheet.read');
    Route::get('/students/export', [SpreadsheetController::class, 'exportStudents'])->name('students.export');
});

require __DIR__.'/auth.php';
