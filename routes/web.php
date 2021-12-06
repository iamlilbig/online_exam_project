<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
})->name('home')->middleware('auth:student');

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect(route('login.students'));
    })->name('login');

    Route::get('/students',[
        StudentController::class,'showLoginForm'
    ])->name('login.students');

    Route::post('/students',[
        StudentController::class,'login'
    ])->name('login.students.login');

    Route::get('/admins',[
        AdminController::class,'showLoginForm'
    ])->name('login.admins');

    Route::post('/admins',[
        AdminController::class,'login'
    ])->name('login.admins.login');

    Route::get('/instructors',[
        InstructorController::class,'showLoginForm'
    ])->name('login.instructors');

    Route::post('/instructors',[
        InstructorController::class,'login'
    ])->name('login.instructors.login');
});

Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return redirect(route('register.students'));
    });

    Route::get('/students',[
        StudentController::class,'showRegisterForm'
    ])->name('register.students');

    Route::post('/students',[
        StudentController::class,'register'
    ])->name('register.students.store');

    Route::get('/instructors',[
        InstructorController::class,'showRegisterForm'
    ])->name('register.instructors');

    Route::post('/instructors',[
        InstructorController::class,'register'
    ])->name('register.instructors.store');
});

Route::prefix('admins')->middleware('auth:admin')->group(function () {
    Route::get('/',function () {
        return redirect(route('admin.home'));
    });

    Route::get('home',[
        AdminController::class,'showHomePage'
    ])->name('admin.home');

    Route::prefix('confirm')->group(function () {
        Route::get('Students',[
            StudentController::class,'showNewStudents'
        ])->name('admin.new.students');

        Route::patch('Students/{id}',[
            StudentController::class,'confirmation'
        ])->name('admin.new.students.confirm');

        Route::get('Instructors',[
            InstructorController::class,'showNewInstructors'
        ])->name('admin.new.instructors');

        Route::patch('Instructors/{id}',[
            InstructorController::class,'confirmation'
        ])->name('admin.new.instructors.confirm');

    });


    Route::prefix('edit')->group(function () {
        Route::get('Students/{id}',[
            StudentController::class,'edit'
        ])->name('admin.edit.students');

        Route::put('Students',[
            StudentController::class,'update'
        ])->name('admin.edit.students.update');

        Route::get('Instructors/{id}',[
            InstructorController::class,'edit'
        ])->name('admin.edit.instructors');

        Route::put('Instructors/',[
            InstructorController::class,'update'
        ])->name('admin.edit.instructors.update');

    });

    Route::get('logout',[
        AdminController::class,'logout'
    ])->name('admins.logout');

    Route::prefix('search')->group(function () {
        Route::get('Students',[
            StudentController::class,'showSearchForm'
        ])->name('admin.search.students.form');

        Route::post('Students',[
            StudentController::class,'search'
        ])->name('admin.search.students');

        Route::get('Instructors',[
            InstructorController::class,'showSearchForm'
        ])->name('admin.search.instructors.form');

        Route::post('Instructors',[
            InstructorController::class,'search'
        ])->name('admin.search.instructors');
    });

    Route::prefix('courses')->group(function () {
        Route::get('create',[
            CourseController::class,'create'
        ])->name('admin.courses.create');

        Route::post('create',[
            CourseController::class,'store'
        ])->name('admin.courses.store');


        Route::get('edit/{id}',[
            CourseController::class,'edit'
        ])->name('admin.courses.info');

        Route::patch('edit/{id}',[
            CourseController::class,'update'
        ])->name('admin.courses.update');

        Route::put('edit/{id}',[
            CourseController::class,'addStudent'
        ])->name('admin.courses.add');

        Route::delete('edit/{id}',[
            CourseController::class,'deleteStudent'
        ])->name('admin.courses.delete');

        Route::get('past',[
            CourseController::class,'pastCourses'
        ])->name('admin.courses.past');

        Route::get('active',[
            CourseController::class,'activeCourses'
        ])->name('admin.courses.active');
    });


    Route::prefix('instructors')->group(function () {
       Route::get('active',[
           InstructorController::class,'active'
       ])->name('admin.instructors.active');
       Route::get('inactive',[
           InstructorController::class,'inactive'
       ])->name('admin.instructors.inactive');
    });

    Route::prefix('students')->group(function () {
       Route::get('active',[
           StudentController::class,'active'
       ])->name('admin.students.active');
       Route::get('inactive',[
           StudentController::class,'inactive'
       ])->name('admin.students.inactive');
    });

});
