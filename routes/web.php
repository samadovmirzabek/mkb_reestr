<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\TexnikaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BolimController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\ExportController;
use App\Models\Departament;

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


Auth::routes();



Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [UserController::class, 'index'])->name('user_sahifa');
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::resource('filial', FilialController::class);
    Route::resource('texnika', TexnikaController::class);
    Route::resource('departament',DepartamentController::class);
    Route::resource('bolim', BolimController::class);
    Route::resource('role', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::post('/get/filial', [FilialController::class, 'getFilial']);
    Route::post('/get/filials', [FilialController::class, 'getFilials']);
    Route::post('/get/dep', [FilialController::class, 'getDep']);
    Route::post('/search', [UserController::class, 'search'])->name('search');
    Route::post('/admin/search',[TexnikaController::class, 'search'])->name('admin.search');
    Route::get('/departamentlar/texnikalari',[DepartamentController::class,'texnikalar'])->name('dep.texnika');
    Route::get('/texnikalar/{filial_id}',[DepartamentController::class, 'dep_bul'])->name('dep_bulim');
    Route::get('/filial/texnikalari/{filial_id}/{texnika_id}',[UserController::class,'filtex'])->name('filials.texnika');
    Route::get('mkb/export/{filial_id}/{departament_id}/{bolim_id}/{texnika_id}',[TexnikaController::class,'export'])->name('mkb.export');
    Route::get('mkb/export_view',[TexnikaController::class,'export_view'])->name('mkb.export_view');
    Route::get('search2/{departament_id}/{texnika_id}',[UserController::class, 'search2'])->name('dep_bul.export');
});
