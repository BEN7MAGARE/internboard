<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\EventListener\ProfilerListener;

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
    Route::delete('/password/change', [ProfileController::class, 'password'])->name('password.change');
    Route::get('profile-jobs', [ProfileController::class, 'jobs'])->name('profile.jobs');
    Route::get('students', [ProfileController::class, 'students'])->name('profile.students');
    Route::get('corporates', [ProfileController::class, 'corporates'])->name('profile.corporates');
    Route::get('opportunities', [ProfileController::class, 'opportunities'])->name('profile.opportunities');
});

Route::view('contact', 'contact')->name('contact');

Route::resource('jobs', JobsController::class);
Route::get('jobs-get', [JobsController::class, 'jobs']);
Route::get('jobs/{ref_no}/apply', [JobsController::class, 'apply']);
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('job-applications/{job_id}', [JobsController::class, 'applications'])->name('job.applications');
Route::get('categories', [JobsController::class, 'categories']);

Route::get('skills', [JobsController::class, 'skills'])->name('skils');

Route::resource('applications', ApplicationsController::class);

Route::get('college-students', [ApplicationsController::class, 'collegeStudents'])->name('college.students');
Route::get('college-applicants/{status}', [ApplicationsController::class, 'schoolStudentApplications'])->name('college.applicants');
Route::get('college-dashboard', [ApplicationsController::class, 'collegeDashboard'])->name('college.dashboard');

Route::get('student/{id}',  [ApplicationsController::class, 'studentDetails'])->name('student.details');
Route::get('application-cvdownload/{id}',[ApplicationsController::class, 'downloadCV'])->name('application.cvdownload');
require __DIR__ . '/auth.php';
