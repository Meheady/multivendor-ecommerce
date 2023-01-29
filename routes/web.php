<?php

use App\Http\Controllers\sociallogin\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;

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
//Clear route cache
Route::get('/route-cache', function() {
    \Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache
Route::get('/config-cache', function() {
    \Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache
Route::get('/clear-cache', function() {
    \Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache
Route::get('/view-clear', function() {
    \Artisan::call('view:clear');
    return 'View cache cleared';
});

// Clear cache using reoptimized class
Route::get('/optimize-clear', function() {
    \Artisan::call('optimize:clear');
    return 'View cache cleared';
});

Route::get('/', function () {
    return view('frontend.index');
})->name('/');

Route::get('/login/facebook',[SocialController::class,'facebookRedirect'])->name('login.facebook');
Route::get('/login/facebook/callback',[SocialController::class,'loginWithFacebook']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified','role:user'])->name('dashboard');


require __DIR__.'/auth.php';

Route::get('/admin/login',[AdminController::class,'adminLogin'])->name('admin.login');
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/profile/update/{id}',[AdminController::class,'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/change/password/',[AdminController::class,'AdminChangePassword'])->name('change.password');
    Route::post('/change/password/save',[AdminController::class,'AdminChangePasswordSave'])->name('save.change.password');

});

Route::get('/vendor/login',[VendorController::class,'vendorLogin'])->name('vendor.login');
Route::middleware(['auth','role:vendor'])->group(function (Route){
    Route::controller(VendorController::class)->group(function (){
        Route::get('/vendor/dashboard','VendorDashboard')->name('vendor.dashboard');

    });
});
