<?php

use App\Http\Controllers\Student\MainController;


Route::prefix('students')->group(function () {
    Route::get('profile', [MainController::class, 'profile'])->name('students.profile');
    Route::get('students', [MainController::class, 'index'])->name('students.index');
    Route::get('create', [MainController::class, 'create'])->name('students.create');
    Route::post('store', [MainController::class, 'store'])->name('students.store');
    Route::get('{id}', [MainController::class, 'show'])->name('students.show');
    Route::get('{id}/edit', [MainController::class, 'edit'])->name('students.edit');
    Route::put('{id}', [MainController::class, 'update'])->name('students.update');
    Route::delete('destroy/{id}', [MainController::class, 'destroy'])->name('students.destroy');
    Route::post('filter', [MainController::class, 'filter'])->name('students.filter');
    Route::post('export', [MainController::class, 'export'])->name('students.export'); 
});
