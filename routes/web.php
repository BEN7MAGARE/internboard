<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('contact', 'contact')->name('contact');

Route::resource('jobs', JobsController::class);
Route::get('jobs-get', [JobsController::class, 'jobs']);
Route::get('jobs/{ref_no}/apply', [JobsController::class, 'apply']);
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('categories', [JobsController::class, 'categories']);

Route::get('skills', [JobsController::class, 'skills'])->name('skils');

require __DIR__.'/auth.php';
