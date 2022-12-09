<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PDFController;

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

Route::get('/', [Controller::class, 'view']);
Route::get('/login', [Controller::class, 'login']);
Auth::routes();

Route::post('/reports',[ReportsController::class,'recordsfilter'])->name('reports/recordsfilter');

Route::prefix('user')->name('user.')->group(function(){

   Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
      Route::view('/login', 'user.login')->name('login');
      Route::post('/check',[UserController::class,'check'])->name('check')->middleware('forceLogout');
      Route::view('/home', 'user.home')->name('home');

   });
   Route::middleware(['auth:web','PreventBackHistory','forceLogout'])->group(function(){

      Route::view('/home', 'user.home')->name('home');
      Route::view('/profile', 'user.profile')->name('profile');
      Route::post('/UpdateInfo', [UserController::class, 'UpdateInfo'])->name('UpdateInfo');
      Route::put('/dashboard/{id}',[UserController::class,'editAttendance'])->name('editAttendance');
      Route::put('/home', [UserController::class, 'store'])->name('store');
      Route::get('/dashboard',[UserController::class,'index1'])->name('dashboard');
      Route::get('/home',[UserController::class,'index2'])->name('home');
      Route::put('/{id}',[UserController::class,'logout'])->name('logout');
   });

});




Route::prefix('admin')->name('admin.')->group(function(){

   Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
      Route::view('/login', 'admin.login')->name('login');
      Route::post('/check2',[AdminController::class,'check2'])->name('check2');
      Route::get('/homeAdmin',[AttendanceController::class,'show2'])->name('show2');
   });
   Route::middleware(['auth:admin' ,'PreventBackHistory'])->group(function(){
      Route::view('/homeAdmin', 'admin.homeAdmin')->name('homeAdmin');
      Route::view('/attendance', 'admin.attendance')->name('attendance');
      Route::get('/attendance',[AttendanceController::class,'index'])->name('index');
      Route::put('/attendance/{id}', [AttendanceController::class, 'assessment'])->name('assessment');
      Route::get('/homeAdmin',[AdminController::class,'dataAtt'])->name('dataAtt');
      Route::post('/UpdateProfile', [AdminController::class, 'UpdateProfile'])->name('UpdateProfile');

      Route::view('/reports', 'admin.reports')->name('reports');
      Route::get('/reports',[ReportsController::class,'displayReports'])->name('displayReports');
      Route::post('/reports',[ReportsController::class,'displayReportsByDate'])->name('displayReportsByDate');
     
      Route::view('/reports_all', 'admin.reports_all')->name('reports_all');
      Route::get('/reports_all',[ReportsController::class,'displayAllReports'])->name('displayAllReports');
      
      Route::view('/employee', 'admin.employee')->name('employee');
      Route::get('/generatePDF', [PDFController::class, 'generatePDF'])->name('generatePDF');


      Route::prefix('employee')->group(function(){
         Route::get('/',[EmployeeController::class,'display'])->name('display');
         Route::put('/', [EmployeeController::class, 'store'])->name('store');
         Route::put('{id}',[EmployeeController::class,'update'])->name('update');
         Route::get('/{employee}/destroy', [EmployeeController::class, 'destroy'])->name('destroy');
      });
   });

});
