<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'getLogin'])->name('auth.login');
Route::post('/', [AuthController::class, 'login'])->name('auth.log');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => 'administrator', 'prefix' => 'administrator'], function () {
    //administrator
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('administrator.dashboard');
    //progam
    Route::get('management/program', [ManagementController::class, 'programIndex'])->name('management.program');
    Route::get('management/program/crepro', [ManagementController::class, 'createprogram'])->name('management.createprogram');
    Route::post('management/program/crepro', [ManagementController::class, 'storeProgram'])->name('management.storeProgram');
    Route::post('management/program/delete', [ManagementController::class, 'deleteProgram'])->name('management.deleteProgram');
    Route::get('management/program/uppro/{pid}', [ManagementController::class, 'getdtoupdate'])->name('management.getdtoupdate');
    Route::post('management/program/uppro/{pid}', [ManagementController::class, 'updateProgram'])->name('management.updateProgram');
    //program category = pc
    Route::get('management/pc/progcat', [ManagementController::class, 'programCatIndex'])->name('management.programcategory');
    Route::get('management/pc/creprocat', [ManagementController::class, 'createprogramCat'])->name('management.createprogramcat');
    Route::post('management/pc/creprocat', [ManagementController::class, 'storeProgamCategory'])->name('management.storeprogramcat');
    Route::get('management/pc/procat/{pc_id}', [ManagementController::class, 'getProgramCategory'])->name('management.getprogramcategory');
    Route::post('management/pc/procat/{pc_id}', [ManagementController::class, 'updateProgramCategory'])->name('management.updateprogramcategory');
    Route::post('management/pc/delete', [ManagementController::class, 'deleteProgramCategory'])->name('management.deleteprogramcategory');
    //admin creating use
    Route::get('user/user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/user/add', [UserController::class, 'createUser'])->name('user.createuser');
    Route::post('user/user/add', [UserController::class, 'storeUser'])->name('user.storeuser');
    Route::get('user/user/mod/{id}', [UserController::class, 'getUserToUpdate'])->name('user.getusertoupdate');
    Route::post('user/user/mod/{id}', [UserController::class, 'updateUser'])->name('user.updateuser');
    Route::get('user/user/stat/{id}', [UserController::class, 'getUserStatus'])->name('user.getuserstatus');
    Route::post('user/user/stat/{id}', [UserController::class, 'updateStatus'])->name('user.updatestatus');
    //assignment
    //user assignment to commodity ascomIndex
    Route::get('user/assignment', [AssignmentController::class, 'ascomIndex'])->name('user.ascomindex');
    //create and modify
    Route::get('user/assignment/crmo/{id}', [AssignmentController::class, 'ascomCreMod'])->name('user.ascomcremod');
    Route::post('user/assignment/crmo/{id}', [AssignmentController::class, 'getcom'])->name('user.getcommodity');
    Route::get('user/assignment/updatestatus/{id}', [AssignmentController::class, 'updatestatus'])->name('user.updatestatus');
    Route::get('user/assignment/delete/{id}', [AssignmentController::class, 'deletestatus'])->name('user.deletestatus');
    //
    Route::get('location/location', [LocationController::class, 'index'])->name('location.index');
    Route::get('location/showprovince/{regid}', [LocationController::class, 'showProvinceByRegion'])->name('location.showprovincebyregion');
    Route::get('location/showcitymun/{provid}', [LocationController::class, 'showCityMunByProvince'])->name('location.showcitymunbyprovince');
});
Route::group(['middleware' => 'technician', 'prefix' => 'technician'], function () {
    //technician
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('technician.dashboard');
});
Route::group(['middleware' => 'guest', 'prefix' => 'guest'], function () {
    //guest
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('guest.dashboard');
});
Route::group(['middleware' => 'officehead', 'prefix' => 'officehead'], function () {
    //officehead
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('ho.dashboard');
});
