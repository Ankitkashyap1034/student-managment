<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/add-student/ajax',[HomeController::class,'viewFormAjax'])->name('ajax.form');
Route::post('/add-student/ajax/',[HomeController::class,'storeStudentAjax'])->name('store.student.ajax');
