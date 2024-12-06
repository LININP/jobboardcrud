<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
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

Route::get('/loginpage',[AuthController::class,'login'])->name('loginpage');

Route::get('/register',[AuthController::class,'registration'])->name('registerpage');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/autheticate', [AuthController::class, 'authenticate'])->name('authenticatepage');





Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('adminpage');
Route::get('/admin/post-status', [AdminController::class, 'jobstatus'])->name('post_status_page');
Route::get('/admin/postview', [AdminController::class, 'postview'])->name('postview');
Route::post('/admin/statusstore', [AdminController::class, 'postStatusStore'])->name('post.status.store');


Route::get('/admin/employer-list', [AdminController::class, 'employerlist'])->name('employerlist_page');
Route::get('/admin/approved-list', [AdminController::class, 'approvedlist'])->name('approved_page');
Route::get('/admin/rejected-list', [AdminController::class, 'rejectedlist'])->name('rejected_page');



Route::middleware(['role:employer', 'auth'])->group(function () {

Route::get('/employer/dashboard',[EmployerController::class,'index'])->name('employerpage');
Route::get('/employer/jobseeker-details', [EmployerController::class, 'jobseeker'])->name('jobseeker_page');
Route::get('/employer/job-form', [EmployerController::class, 'jobform'])->name('jobform_page');
Route::post('/employer/formstore',[EmployerController::class,'FormStore'])->name('postjobstoring');
Route::get('/employer/approvedpage', [EmployerController::class, 'approved'])->name('approvepage');
Route::get('/employer/rejectedpage', [EmployerController::class, 'rejected'])->name('rejectpage');
Route::get('/employer/shortlisted', [EmployerController::class, 'shortlisted'])->name('shortlistedpage');
});

Route::get('/jobseeker/dashboard',[JobSeekerController::class,'index'])->name('jobseekerpage');
Route::get('/jobseeker/apply-job',[JobSeekerController::class,'applyjob'])->name('applyjobpage');
Route::get('/jobseeker/view-post',[JobSeekerController::class,'viewpost'])->name('viewpostpage');
Route::get('/jobseeker/approved',[JobSeekerController::class,'approved'])->name('approvedpage');
Route::get('/jobseeker/rejected',[JobSeekerController::class,'rejected'])->name('rejectedpage');
Route::get('/jobseeker/pending',[JobSeekerController::class,'pending'])->name('pendingpage');



