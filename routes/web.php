<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\frontend\IndexController;


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

//admin routes
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class,'Index'])->name('login_from');
    Route::post('/login/owner',[AdminController::class,'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class,'destroy'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class,'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class,'AdminRegisterCreate'])->name('admin.register.create');


    
});
//end admin routes

//routes profile admin
Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile')->middleware('admin');
Route::get('/admin/profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit')->middleware('admin');
Route::post('/admin/profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store')->middleware('admin');
Route::get('/admin/change/password',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password')->middleware('admin');
Route::post('/admin/update/password',[AdminProfileController::class,'UpdateChangePassword'])->name('update.change.password')->middleware('admin');

//end routes profile admin

//seller routes
Route::prefix('seller')->group(function(){
    Route::get('/login',[SellerController::class,'Index'])->name('seller_login_from');
    Route::post('/login/owner',[SellerController::class,'Login'])->name('seller.login');
    Route::get('/dashboard',[SellerController::class,'Dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout',[SellerController::class,'SellerLogout'])->name('seller.logout')->middleware('seller');
    Route::get('/register',[SellerController::class,'SellerRegister'])->name('seller.register');
    Route::post('/register/create',[SellerController::class,'SellerRegisterCreate'])->name('seller.register.create');

});
//end seller routes

//home routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/',[IndexController::class,'Index']);
Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');
Route::post('/user/profile/store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password',[IndexController::class,'UserChangePassword'])->name('change.password');
Route::post('/user/update/password',[IndexController::class,'UserUpdatePassword'])->name('user.password.update');

//end home routes


Route::get('/c', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
