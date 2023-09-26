<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmActivityController;
use App\Http\Controllers\FarmDetailController;
use App\Http\Controllers\FarmerFisherFolkController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\RBOController;
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

Route::group(['middleware' => ['administrator', 'nohistory'], 'prefix' => 'administrator'], function () {
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
    //create url for loadProgramCategory($program_id)
    Route::get('management/pc/programcat/{pc_id}', [ManagementController::class, 'loadProgramCategory'])
        ->name('management.loadprogramcategory');
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
    Route::post('user/assignment/crba/{id}', [AssignmentController::class, 'storeBarAssigned'])->name('user.storebarassigned');
    Route::get('user/assignment/updatebarstatus/{id}', [AssignmentController::class, 'updateBarStatus'])->name('user.updatebarstatus');
    Route::get('user/assignment/deletebar/{id}', [AssignmentController::class, 'deleteBar'])->name('user.deletebar');
    //
    Route::get('location/location', [LocationController::class, 'index'])->name('location.index');
    Route::get('location/showprovince/{regid}', [LocationController::class, 'showProvinceByRegion'])->name('location.showprovincebyregion');
    Route::get('location/showcitymun/{provid}', [LocationController::class, 'showCityMunByProvince'])->name('location.showcitymunbyprovince');
    Route::post('location/location', [LocationController::class, 'store'])->name('location.store');
    Route::post('location/update/', [LocationController::class, 'update'])->name('location.update');
    //for the RBO - List
    Route::get('rbo/list', [RBOController::class, 'index'])->name('rbo.index');
    Route::get('rbo/cluster', [RBOController::class, 'cluster'])->name('rbo.cluster');
    Route::get('rbo/association', [RBOController::class, 'association'])->name('rbo.association');
    Route::get('rbo/association/create', [RBOController::class, 'createAssociation'])->name('rbo.createassociation');
    Route::post('rbo/association/create', [RBOController::class, 'storeAssociation'])->name('rbo.storeassociation');
    Route::get('rbo/association/updatestatus/{id}', [RBOController::class, 'updateStatus'])->name('rbo.updatestatus');
    Route::get('rbo/association/update/{id}', [RBOController::class, 'update'])->name('rbo.update');
    Route::post('rbo/association/update/{id}', [RBOController::class, 'updateAssociation'])->name('rbo.updateassociation');
    //farmer and fisherfolk
    Route::get('f2/list', [FarmerFisherFolkController::class, 'index'])->name('f2.index');
    Route::get('f2/list/information/{id}', [FarmerFisherFolkController::class, 'information'])->name('f2.information');
    Route::post('f2/list/information/{id}', [FarmerFisherFolkController::class, 'update'])->name('f2.update');
    Route::get('f2/list/create', [FarmerFisherFolkController::class, 'create'])->name('f2.create');
    Route::post('f2/list/create', [FarmerFisherFolkController::class, 'store'])->name('f2.store');
    Route::get('f2/list/details/{id}', [FarmerFisherFolkController::class, 'details'])->name('f2.details');
    Route::post('f2/list/details/{id}', [FarmerFisherFolkController::class, 'updateDetails'])->name('f2.updatedetails');
    Route::get('f2/list/livelihood/{id}', [FarmerFisherFolkController::class, 'livelihood'])->name('f2.livelihood');
    Route::post('f2/list/livelihood/{id}', [FarmerFisherFolkController::class, 'updateLivelihood'])->name('f2.livelihoodupdate');
    //farm details
    Route::get('f2/list/farm/{id}', [FarmDetailController::class, 'index'])->name('f2.farm');
    //farm details form
    Route::get('f2/list/farm/{id}/create', [FarmDetailController::class, 'registerFarmDetails'])->name('f2.registerfarmdetails');
    Route::post('f2/list/farm/{id}/create', [FarmDetailController::class, 'storeFarmDetails'])->name('f2.storefarmdetails');
    Route::get('f2/list/farm/updatefarm/{id}', [FarmDetailController::class, 'getFarmDetails'])->name('f2.getfarmdetails');
    Route::post('f2/list/farm/updatefarm/{id}', [FarmDetailController::class, 'updateFarmDetails'])->name('f2.updatefarmdetails');
    Route::get('f2/list/farm/updatefarmstatus/{id}', [FarmDetailController::class, 'updateFarmStatus'])->name('f2.updatefarmstatus');
    //farm activity
    Route::get('f2/list/activity/{id}', [FarmActivityController::class, 'index'])->name('f2.activity');
    //route for creating new activity
    Route::get('f2/list/activity/{id}/create/{fid}', [FarmActivityController::class, 'createActivity'])->name('f2.createActivity'); 
    Route::post('f2/list/activity/{id}/create/{fid}', [FarmActivityController::class, 'storeActivity'])->name('f2.storeactivity');
    Route::get('f2/list/activity/{id}/farm/{fid}/mod/{aid}', [FarmActivityController::class, 'updateActivity'])->name('f2.updateactivity');  
    Route::post('f2/list/activity/{id}/farm/{fid}/mod/{aid}', [FarmActivityController::class, 'getDataToUpdate'])->name('f2.getdatatoupdate');  
});
Route::group(['middleware' => ['nohistory', 'technician'], 'prefix' => 'technician'], function () {
    //technician
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('technician.dashboard');
});
Route::group(['middleware' => ['nohistory', 'guest'], 'prefix' => 'guest'], function () {
    //guest
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('guest.dashboard');
});
Route::group(['middleware' => ['nohistory', 'officehead'], 'prefix' => 'officehead'], function () {
    //officehead
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('ho.dashboard');
});
