<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;

Route::get('/', [ApplicationsController::class, 'welcome'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
Route::post('contact', [ApplicationsController::class, 'contact']);
Route::view('about', 'about')->name('about');
Route::view('services', 'comingsoon')->name('services');

Route::resource('jobs', JobsController::class);
Route::get('jobs-get', [JobsController::class, 'jobs']);
Route::post('jobs-search', [JobsController::class, 'search'])->name('jobs.search');
Route::post('jobs-json-search', [JobsController::class, 'jsonSearch'])->name('jobs.json.search');
Route::get('jobs/{ref_no}/apply', [JobsController::class, 'apply']);
Route::post('job/apply', [JobsController::class, 'applicationCreate'])->name('job.apply');
Route::get('job-applications/{ref_no}', [JobsController::class, 'applications'])->name('job.applications');
Route::get('categoriesdata', [JobsController::class, 'categories']);
Route::get('categories-with-jobs', [JobsController::class, 'categoriesWithJobs']);

Route::get('skills', [JobsController::class, 'skills'])->name('skils');

Route::resource('applications', ApplicationsController::class);

Route::get('college-applicants/{status}', [ApplicationsController::class, 'schoolStudentApplications'])->name('college.applicants');
Route::get('college-applications', [CollegeController::class, 'applications'])->name('college.applications');
Route::get('college-dashboard', [CollegeController::class, 'dashboard'])->name('college.dashboard');
Route::get('collegesdata',[CollegeController::class,'getColleges']);
Route::get('college-students', [CollegeController::class, 'students'])->name('college.students');

Route::resource('corporates', CorporateController::class);
Route::get('corporatesdata',[CorporateController::class,'getCorporates']);

Route::resource('colleges', CollegeController::class);

Route::resource('students', StudentController::class);
Route::post('students/filter', [StudentController::class, 'filter'])->name('students.filter');
Route::post('students/export', [StudentController::class, 'export'])->name('students.export');

Route::resource('users', UserController::class);
Route::post('college-user-store', [UserController::class, 'collegeUserStore'])->name('college.user.store');
Route::post('corporate-user-store', [UserController::class, 'corporateUserStore'])->name('corporate.user.store');


Route::resource('categories', CategoryController::class);
Route::get('categorysubs/{id}', [CategoryController::class, 'getSubCategories']);
Route::resource('subcategories', SubcategoryController::class);
Route::get('category/{slug}', [CategoryController::class, 'jobs'])->name('category.show');

Route::resource('courses', CourseController::class);
Route::get('coursesdata',[CourseController::class,'getCourses']);
Route::get('coursescategoriesdata',[CourseController::class,'getCourseCategories']);

Route::get('student/{id}', [StudentController::class, 'show'])->name('student.details');
Route::get('application-cvdownload/{id}', [ApplicationsController::class, 'downloadCV'])->name('application.cvdownload');
Route::get('download/{file}', [ApplicationsController::class, 'download'])->name('download.file');

Route::post('applications-select', [ApplicationsController::class, 'select'])->name('applications.select');

Route::get('elearning', [ApplicationsController::class, 'elearning'])->name('elearning');

Route::get('jobs-locations', [JobsController::class, 'jobsLocations']);

Route::post('profileimage', [ProfileController::class, 'changeImage']);

Route::get('counties', [ApplicationsController::class, 'counties']);

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'sw'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

Route::get('/refresh-csrf', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});


require __DIR__ . '/auth.php';
require __DIR__ . '/training.php';

