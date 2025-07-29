<?php

use App\Http\Controllers\Student\MainController;


    Route::get('student-profile', [MainController::class, 'profile'])->name('student.profile');
    Route::get('student-create', [MainController::class, 'create'])->name('student.create');
    Route::post('student-store', [MainController::class, 'store'])->name('student.store');
    Route::get('student/{id}', [MainController::class, 'show'])->name('student.show');
    Route::get('student/{id}/edit', [MainController::class, 'edit'])->name('student.edit');
    Route::put('student/{id}', [MainController::class, 'update'])->name('student.update');
    Route::delete('student-destroy/{id}', [MainController::class, 'destroy'])->name('student.destroy');
    Route::post('student-filter', [MainController::class, 'filter'])->name('student.filter');
    Route::post('student-export', [MainController::class, 'export'])->name('student.export');
    Route::get('student-contracts', [MainController::class, 'contracts'])->name('student.contracts');
    Route::get('student-applications', [MainController::class, 'applications'])->name('student.applications');
