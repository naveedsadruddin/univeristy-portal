<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/user/enroll/', [EnrollmentController::class,'create']);
    Route::post('enroll/{id}', [EnrollmentController::class,'store']);
    Route::get('enroll', [EnrollmentController::class,'index'])->name('enroll.index');
    Route::post('deenroll/{id}', [EnrollmentController::class,'destroy'])->name('enroll.index');
    Route::get('user/enrollments', [EnrollmentController::class,'userEnrollments'])->name('user.enrollments');
    Route::get('/user/courses/', [CourseController::class,'userCourses']);
    Route::get('/user/courses/enrollments', [CourseController::class,'userCourseEnrollments']);
    // userCourseEnrollments
});



require __DIR__.'/auth.php';
