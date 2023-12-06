<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;

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

Route::get('/index',[HomeController::class,'view'])->name('index');
Route::get('/add-student',[HomeController::class,'viewForm'])->name('add.student');
Route::post('/add-student',[HomeController::class,'store'])->name('store.student');
Route::get('/listing',[HomeController::class,'viewList'])->name('listing');
Route::get('/delete-student/{student}',[HomeController::class,'destroy'])->name('delete.student');
Route::get('/edit-student/{student}',[HomeController::class,'viewEditStudent'])->name('edit.student.view');
Route::put('/edit-student/',[HomeController::class,'storeEditStudent'])->name('edit.student.store');
Route::get('/student-details/{student}',[HomeController::class,'viewStudent'])->name('view.student.details');

Route::get('/add-student/ajax',[HomeController::class,'viewFormAjax'])->name('ajax.form')->middleware('auth');
Route::post('/add-student/ajax/',[HomeController::class,'storeStudentAjax'])->name('store.student.ajax');

// authentication routes
Route::get('/student-login',[StudentAuthController::class,'viewStudentLogin'])->name('login.student');
Route::post('/student-login',[StudentAuthController::class,'login'])->name('login');
Route::get('/student-logut',[StudentAuthController::class,'logout'])->name('logout');

// for student panel
Route::get('/student-index',[StudentController::class,'index'])->name('home.student')->middleware('auth');

