<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketController;

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

Route::get('admin/students', [StudentController::class, 'index'])->name('admin.students.index');
Route::post('students-store', [StudentController::class, 'store'])->name('admin.students.store');

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
Route::post('jobs-approve', [JobsController::class, 'approve'])->name('jobs.approve');

Route::get('application-details/{id}', [JobsController::class, 'applicationsDetails'])->name('job.applications.details');

Route::get('categoriesdata', [JobsController::class, 'categories']);
Route::get('categories-with-jobs', [JobsController::class, 'categoriesWithJobs']);

Route::resource('applications', ApplicationsController::class);

Route::get('college-applicants/{status}', [ApplicationsController::class, 'schoolStudentApplications'])->name('college.applicants');
Route::get('college-dashboard', [CollegeController::class, 'dashboard'])->name('college.dashboard');
Route::get('collegesdata',[CollegeController::class,'getColleges']);
Route::get('college-students', [CollegeController::class, 'students'])->name('college.students');

Route::resource('employer', EmployerController::class);
Route::get('employers', [EmployerController::class, 'index'])->name('employers.index');
Route::post('employers-approve', [EmployerController::class, 'approve'])->name('employer.approve');
Route::get('employersdata',[EmployerController::class,'getCorporates']);
Route::get('skills-by-category/{id}', [SkillController::class, 'skillsByCategory']);
Route::resource('colleges', CollegeController::class);
Route::resource('skills', SkillController::class);
Route::get('skillsdata',[SkillController::class,'getSkills']);

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

Route::get('student-public-profile/{id}', [StudentController::class, 'profile'])->name('student.details');
Route::get('application-cvdownload/{id}', [ApplicationsController::class, 'downloadCV'])->name('application.cvdownload');
Route::get('download/{file}', [ApplicationsController::class, 'download'])->name('download.file');

Route::post('applications-select', [ApplicationsController::class, 'select'])->name('applications.select');
Route::get('applications-selected/{ref_no}', [ApplicationsController::class, 'selected'])->name('applications.selected');
Route::post('applications-hire', [ApplicationsController::class, 'hire'])->name('applications.hire');

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

Route::resource('market', MarketController::class);
Route::post('market-search', [MarketController::class, 'search'])->name('market.search');

require __DIR__ . '/auth.php';
require __DIR__ . '/training.php';
require __DIR__ . '/employer.php';
require __DIR__ . '/college.php';
require __DIR__ . '/student.php';

Route::post('checkappstatus', [ApplicationsController::class, 'checkAppStatus'])->name('checkappstatus');

