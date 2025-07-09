<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;

Route::get('jobs', [JobsController::class, 'index'])->name('jobs.index');
Route::get('job/{id}', [JobsController::class, 'show'])->name('job.show');
Route::get('job/{id}/apply', [JobsController::class, 'apply'])->name('job.apply');
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('job-applications/{ref_no}', [JobsController::class, 'applications'])->name('job.applications');
Route::get('jobsdata', [JobsController::class, 'jobs']);
Route::get('jobs-get', [JobsController::class, 'jobs']);
Route::post('jobs-search', [JobsController::class, 'search'])->name('jobs.search');
Route::post('jobs-json-search', [JobsController::class, 'jsonSearch'])->name('jobs.json.search');
Route::get('jobs/{ref_no}/apply', [JobsController::class, 'apply']);
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('job-applications/{ref_no}', [JobsController::class, 'applications'])->name('job.applications');
Route::get('categoriesdata', [JobsController::class, 'categories']);
Route::get('categories-with-jobs', [JobsController::class, 'categoriesWithJobs']);
Route::get('skills', [JobsController::class, 'skills'])->name('skils');
