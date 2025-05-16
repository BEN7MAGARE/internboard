<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');

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

Route::get('profile/applications', [ProfileController::class, 'applications'])->name('profile.applications');

Route::view('contact', 'contact')->name('contact');
Route::view('about', 'about')->name('about');
Route::view('services', 'services')->name('services');

Route::resource('jobs', JobsController::class);
Route::get('jobs-get', [JobsController::class, 'jobs']);
Route::post('jobs-search', [JobsController::class, 'search'])->name('jobs.search');
Route::post('jobs-json-search', [JobsController::class, 'jsonSearch'])->name('jobs.json.search');
Route::get('jobs/{ref_no}/apply', [JobsController::class, 'apply']);
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('job-applications/{job_id}', [JobsController::class, 'applications'])->name('job.applications');
Route::get('categories', [JobsController::class, 'categories']);
Route::get('categories-with-jobs', [JobsController::class, 'categoriesWithJobs']);

Route::get('skills', [JobsController::class, 'skills'])->name('skils');

Route::resource('applications', ApplicationsController::class);

Route::get('college-applicants/{status}', [ApplicationsController::class, 'schoolStudentApplications'])->name('college.applicants');
Route::get('college-applications', [ApplicationsController::class, 'collegeApplications'])->name('college.applications');
Route::get('college-dashboard', [ApplicationsController::class, 'collegeDashboard'])->name('college.dashboard');

Route::resource('corporate', CorporateController::class);

Route::resource('college', CollegeController::class);

Route::resource('students', StudentController::class);

Route::get('student/{id}', [ApplicationsController::class, 'studentDetails'])->name('student.details');
Route::get('application-cvdownload/{id}', [ApplicationsController::class, 'downloadCV'])->name('application.cvdownload');
Route::get('download/{file}', [ApplicationsController::class, 'download'])->name('download.file');

Route::post('applications-select', [ApplicationsController::class, 'select'])->name('applications.select');

Route::get('elearning', [ApplicationsController::class, 'elearning'])->name('elearning');

Route::get('jobs-locations', [JobsController::class, 'jobsLocations']);

Route::post('profileimage', [ProfileController::class, 'changeImage']);

require __DIR__ . '/auth.php';
