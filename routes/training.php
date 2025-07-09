<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;

Route::get('elearning/employability', [TrainingController::class, 'employability'])->name('elearning.employability');
Route::get('elearning/entrepreneurship', [TrainingController::class, 'entrepreneurship'])->name('elearning.entrepreneurship');
