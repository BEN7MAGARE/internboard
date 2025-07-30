<?php

use App\Http\Controllers\Employer\MainController;
use App\Http\Controllers\Employer\ProductController;

Route::get('employer', [MainController::class, 'index'])->name('employer');
Route::get('employer/create', [MainController::class, 'create'])->name('employer.create');
// Route::post('employer/store', [MainController::class, 'store'])->name('employer.store');
Route::get('employer/{id}/applicants', [MainController::class, 'applicants'])->name('employer.applicants');
Route::get('employer-applications', [MainController::class, 'applications'])->name('employer.applications');
Route::get('employer-job-applications/{ref_no}', [MainController::class, 'jobApplications'])->name('employer.job.applications');

Route::get('employer-jobs', [MainController::class, 'jobs'])->name('employer.jobs');
Route::get('employer-jobs-destroy/{id}',[MainController::class,'deleteJob'])->name('employer.jobs.destroy');
Route::get('employer-contacts', [MainController::class, 'contacts'])->name('employer.contacts');
Route::get('employer-contact-detail/{id}', [MainController::class, 'contactDetail'])->name('employer.contact.detail');
Route::get('employer-contacts/{id}', [MainController::class, 'contactShow'])->name('employer.contacts.show');
Route::get('employer-contacts-delete/{id}', [MainController::class, 'contactDelete'])->name('employer.contacts.delete');
Route::get('employer-profile', [MainController::class, 'profile'])->name('employer.profile');
Route::get('employer-products', [ProductController::class, 'index'])->name('employer.products');
Route::get('employer-product/{id}', [ProductController::class, 'show'])->name('employer.product.show');
Route::post('employer-product-store', [ProductController::class, 'store'])->name('employer.product.store');
Route::delete('employer-product-destroy/{id}', [ProductController::class, 'destroy'])->name('employer.product.destroy');
Route::post('employer-product-image-destroy/{id}', [ProductController::class, 'deleteProductImage'])->name('employer.product.image.destroy');

Route::get('employer-workers', [MainController::class, 'workers'])->name('employer.workers');
