<?php

use App\Http\Controllers\College\ContactController;
use App\Http\Controllers\College\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware('college')->prefix('college')->group(function () {
    Route::get('profile', [MainController::class, 'profile'])->name('college.profile');
    Route::get('contacts', [ContactController::class, 'index'])->name('college.contacts');
    Route::get('contacts/{id}', [ContactController::class, 'show'])->name('college.contact.show');
    Route::get('contacts/{id}/edit', [ContactController::class, 'edit'])->name('college.contact.edit');
    Route::post('contact-store', [ContactController::class, 'store'])->name('college.contact.store');
    Route::post('contact-update', [ContactController::class, 'update'])->name('college.contact.update');
    Route::post('contact-delete', [ContactController::class, 'destroy'])->name('college.contact.destroy');

    Route::get('students', [MainController::class, 'students'])->name('college.students');
    Route::get('applications', [MainController::class, 'applications'])->name('college.applications');
    Route::post('students-import', [MainController::class, 'importStudents'])->name('college.students.imports');
    Route::get('students-template-download', [MainController::class, 'downloadStudentsTemplate'])->name('students.template.download');

    Route::get('courses',[MainController::class,'courses'])->name('college.courses');
});
