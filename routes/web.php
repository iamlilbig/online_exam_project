<?php

use App\Http\Controllers\AdminController;
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
})->name('home');

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

    Route::prefix('create')->group(function () {
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
});
