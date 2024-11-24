<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcademicHeadController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacalityController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::group(['prefix' => 'faculity'], function () {
            Route::get('/', [App\Http\Controllers\FaculityController::class, 'index'])->name('admin.faculity.index');
            Route::post('/store', [App\Http\Controllers\FaculityController::class, 'store'])->name('admin.faculity.store');
            Route::get('/edit/{id}', [App\Http\Controllers\FaculityController::class, 'edit'])->name('admin.faculity.edit');
            Route::post('/update/{id}', [App\Http\Controllers\FaculityController::class, 'update'])->name('admin.faculity.update');
            Route::get('/delete/{id}', [App\Http\Controllers\FaculityController::class, 'delete'])->name('admin.faculity.delete');
        });

        Route::post('/semester/store',[App\Http\Controllers\CourseController::class, 'semesterStore'])->name('admin.semester.store');
        
        Route::post('/syllabus/store',[App\Http\Controllers\CourseController::class, 'syllabusStore'])->name('admin.syllabus.store');
        
    });

    Route::middleware(['can:isAdminOrAcademicHead'])->group(function () {
        Route::group(['prefix' => 'course'], function () {
            Route::get('/create',[App\Http\Controllers\CourseController::class, 'create'])->name('admin.course.create');
            Route::post('/store',[App\Http\Controllers\CourseController::class, 'store'])->name('admin.course.store');
            Route::get('/edit/{id}',[App\Http\Controllers\CourseController::class, 'edit'])->name('admin.course.edit');
            Route::post('/update/{id}',[App\Http\Controllers\CourseController::class, 'update'])->name('admin.course.update');
            Route::get('/delete/{id}',[App\Http\Controllers\CourseController::class, 'delete'])->name('admin.course.delete');
        });

        Route::group(['prefix' => 'module'], function () {
            Route::post('/store',[App\Http\Controllers\ModuleController::class, 'store'])->name('admin.module.store');
            Route::get('/edit/{id}',[App\Http\Controllers\ModuleController::class, 'edit'])->name('admin.module.edit');
            Route::post('/update/{id}',[App\Http\Controllers\ModuleController::class, 'update'])->name('admin.module.update');
            Route::get('/delete/{id}',[App\Http\Controllers\ModuleController::class, 'delete'])->name('admin.module.delete');
        });
        Route::get('/syllabus/duplicate',[App\Http\Controllers\CourseController::class, 'syllabusDuplicate'])->name('admin.syllabus.duplicate');

       // Route::get('/syllabus/duplicate/{id}',[App\Http\Controllers\CourseController::class, 'syllabusDuplicate'])->name('admin.syllabus.duplicate');

    });

    Route::middleware(['can:isAdminOrTeacher'])->group(function () {
        Route::get('/teacher/create',[App\Http\Controllers\AdminController::class, 'teacherCreate'])->name('admin.teacher.create');
        Route::post('/teacher/store',[App\Http\Controllers\AdminController::class, 'teacherStore'])->name('admin.teacher.store');
        Route::get('/teacher/{id}',[App\Http\Controllers\AdminController::class, 'teacherView'])->name('admin.teacher.view');
    });

    Route::middleware(['can:isAdminOrStudent'])->group(function () {
        Route::get('/student/create',[App\Http\Controllers\AdminController::class, 'studentCreate'])->name('admin.student.create');
        Route::post('/student/store',[App\Http\Controllers\AdminController::class, 'studentStore'])->name('admin.student.store');
        Route::get('/student/{id}',[App\Http\Controllers\AdminController::class, 'studentView'])->name('admin.student.view');
    });

    Route::get('/module/create',[App\Http\Controllers\ModuleController::class, 'create'])->name('admin.module.create');
    Route::get('/syllabus/create',[App\Http\Controllers\CourseController::class, 'syllabusCreate'])->name('admin.syllabus.create');

    Route::get('/semester/create',[App\Http\Controllers\CourseController::class, 'semesterCreate'])->name('admin.semester.create');
    Route::get('/semester/view/{id}',[App\Http\Controllers\CourseController::class, 'semesterView'])->name('admin.semester.view');
});
