<?php

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

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//=======================================================================================================//

Route::get('/', [FrontendController::class, 'getIndex'])->name('welcome');
Route::get('/visit-site', [FrontendController::class, 'visitSite'])->name('visit-site');

//=================== Frontend Controller Bangla ===================

Route::post('/user-login', [AdminController::class, 'authenticate'])->name('adminuser.login');

//=================== admin middleware ===================

// Route::group(['prefix' => 'admin/'], function () {
Route::group(['middleware' => 'admin.guest'], function () {

    //=================== Guest Route ===================

});

//=================== Backend Route Start From here ===================

Route::group(['middleware' => 'admin.auth'], function () {

    //=================== Admin Logout ===================


    //=================== Dashboard Controller ===================

    Route::get('home', [DashboardController::class, 'getIndex'])->name('admin.dashboard');

    //=================== Admin Profile Controller ===================

    Route::get('user/profile', [AdminProfileController::class, 'getIndex'])->name('admin.profile');
    Route::post('user/profile/update-profile', [AdminProfileController::class, 'postUpdateProfile'])->name('admin.update-profile');
    Route::post('user/profile/update-profile-picture/', [AdminProfileController::class, 'postUpdateProfilePicture'])->name('admin.update-picture');
    Route::get('user/profile/remove/profile-picture', [AdminProfileController::class, 'getRemovePicture'])->name('admin.remove-picture');
    Route::get('user/change-password', [AdminProfileController::class, 'getEditPassword'])->name('admin.change-password');
    Route::post('user/change-password/update', [AdminProfileController::class, 'postUpdatePassword'])->name('admin.change-password.update');

    Route::get('user-info/update', [AdminProfileController::class, 'agentInfoUpdate'])->name('agent-info.update');    //agent user info update 
 
    //=================== Permission Controller ===================

    Route::resource('permissions', 'Admin\PermissionsController');

    //=================== Role Controller ===================

    Route::resource('roles', 'Admin\RolesController');

    //=================== Service Provider Controller ===================

    Route::resource('serviceProviders', 'Admin\ServiceProvidersController');


    Route::get('all/admin-users', [AdminUserController::class, 'getIndex'])->name('admin-users.index');
    Route::get('admin-users/create', [AdminUserController::class, 'getCreate'])->name('admin-users.create');
    Route::post('admin-users/store', [AdminUserController::class, 'postStore'])->name('admin-users.store');
    Route::get('admin-users/edit/{id}', [AdminUserController::class, 'getEdit'])->name('admin-users.edit');
    Route::post('admin-users/update/{id}', [AdminUserController::class, 'postUpdate'])->name('admin-users.update');
    Route::get('admin-users/delete/{id}', [AdminUserController::class, 'getDestroy'])->name('admin-users.destroy');
    Route::get('admin-users/disable/{id}', [AdminUserController::class, 'inActive'])->name('admin-users.inactive');
    Route::get('admin-users/enable/{id}', [AdminUserController::class, 'active'])->name('admin-users.active');

    //=================== User Controller ===================

    Route::get('all/user', [UserController::class, 'getIndex'])->name('user.index');
    Route::get('user/create', [UserController::class, 'getCreate'])->name('user.create');
    Route::post('user/store', [UserController::class, 'postStore'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'getEdit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'postUpdate'])->name('user.update');
    Route::get('user/delete/{id}', [UserController::class, 'getDestroy'])->name('user.destroy');
    Route::get('user/disable/{id}', [UserController::class, 'inActive'])->name('user.inactive');
    Route::get('user/enable/{id}', [UserController::class, 'active'])->name('user.active');
    Route::get('user/credit/{id}', [UserController::class, 'getCreditForm'])->name('user.credit');

    //=================== Message Controller ===================

    Route::get('all/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('message/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('message/store', [MessageController::class, 'store'])->name('message.store');
    Route::get('message/view/{id}', [MessageController::class, 'view'])->name('message.view');
    Route::post('message/update/{id}', [MessageController::class, 'update'])->name('message.update');
    Route::get('message/delete/{id}', [MessageController::class, 'destory'])->name('message.destroy');
    Route::get('message/disable/{id}', [MessageController::class, 'inActive'])->name('message.inactive');
    Route::get('message/enable/{id}', [MessageController::class, 'active'])->name('message.active');
    
});

Auth::routes();
