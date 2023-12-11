<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
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
    return view('welcome');
});

Route::get('/index', [HomeController::class, 'view'])->name('index');
Route::get('/add-student', [HomeController::class, 'viewForm'])->name('add.student');
Route::post('/add-student', [HomeController::class, 'store'])->name('store.student');
Route::get('/listing', [HomeController::class, 'viewList'])->name('listing');
Route::get('/delete-student/{student}', [HomeController::class, 'destroy'])->name('delete.student');
Route::get('/edit-student/{student}', [HomeController::class, 'viewEditStudent'])->name('edit.student.view');
Route::put('/edit-student/', [HomeController::class, 'storeEditStudent'])->name('edit.student.store');
Route::get('/student-details/{student}', [HomeController::class, 'viewStudent'])->name('view.student.details');

Route::get('/add-student/ajax', [HomeController::class, 'viewFormAjax'])->name('ajax.form')->middleware('auth');
Route::post('/add-student/ajax/', [HomeController::class, 'storeStudentAjax'])->name('store.student.ajax');

// authentication routes
Route::get('/student-login', [StudentAuthController::class, 'viewStudentLogin'])->name('login.student');
Route::post('/student-login', [StudentAuthController::class, 'login'])->name('login');
Route::get('/student-logut', [StudentAuthController::class, 'logout'])->name('logout');

// for student panel
Route::get('/student-index', [StudentController::class, 'index'])->name('home.student')->middleware('auth');
Route::get('/student/attendance/', [StudentController::class, 'viewAttendance'])->name('attendance.student.view')->middleware('auth');

// staff routes

Route::middleware('auth')->prefix('staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'viewDashboard'])->name('dashboard.staff');
    Route::get('/profile', [StaffController::class, 'viewStaffIndex'])->name('staff.profile');
    Route::get('/add-student', [StaffController::class, 'viewAddStudentForm'])->name('add.student.staff');
    Route::get('/listing', [StaffController::class, 'viewListStudent'])->name('listing.student.staff');
    Route::get('/fee-pay', [StaffController::class, 'feePayView'])->name('pay.fee.view');
    Route::get('/student-info/{studentMobile}', [StaffController::class, 'getStudentInfo'])->name('get.student.info');
    Route::post('/fee-pay/store', [StaffController::class, 'storeFee'])->name('pay.fee.store');
    Route::get('/fee-pay/listing', [StaffController::class, 'viewListFee'])->name('listing.fee');
    Route::get('/student-listing/fiterd/{class}', [StaffController::class, 'viewListStudentFiltered'])->name('listing.student.filter');
    Route::put('/profile-details/', [StaffController::class, 'storeProfileUpdate'])->name('store.profile.staff');
    // Route::get('/student-attendance/', [StaffController::class, 'viewStudentAttendance'])->name('view.student.attendance');
    Route::get('/student-attendance/', [StaffController::class, 'viewStudentAttendanceByStudent'])->name('view.student.attendance.id');
    Route::post('student-attedance/update', [StaffController::class, 'storeStudentAttendanceByStudent'])->name('view.student.attendance');
});
Route::get('/login', [StaffController::class, 'viewStaffLogin'])->name('login.staff');
Route::post('/login', [StaffController::class, 'loginStaff'])->name('login.staff');
Route::get('/logout', [StaffController::class, 'logoutStaff'])->name('logout.staff');

Route::middleware('auth')->prefix('product')->group(function () {
    Route::get('/add-category', [ProductController::class, 'viewAddCatogery'])->name('add.category.view');
    Route::post('/add-category', [ProductController::class, 'storeCatogery'])->name('add.category.store');
    Route::get('/category-list', [ProductController::class, 'viewCategoryList'])->name('lsiting.category');
    Route::get('/edit-category/{category}', [ProductController::class, 'getCategoryDetails'])->name('get.category.info');
    Route::put('/edit-category/', [ProductController::class, 'storeCategoryUpdate'])->name('edit.category.store');
    Route::get('/add-product', [ProductController::class, 'viewAddProduct'])->name('add.product.view');
    Route::post('/add-product', [ProductController::class, 'storeProduct'])->name('add.product.store');
    Route::get('/product-list', [ProductController::class, 'viewProdcutList'])->name('lsiting.product');
    Route::get('/edit-product/{product}', [ProductController::class, 'getProductDetails'])->name('get.product.info');
    Route::put('/edit-product/', [ProductController::class, 'storeProductDetails'])->name('edit.product.store');
});
