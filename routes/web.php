<?php

use App\Http\Controllers\sociallogin\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;

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


Route::controller(UserController::class)->middleware(['auth','verified','role:user'])->group(function (){
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::post('/user/profile/update','updateProfile')->name('user.profile.update');
    Route::post('/user/change/password','changePassword')->name('user.change.password');
});


require __DIR__.'/auth.php';

Route::get('/admin/login',[AdminController::class,'adminLogin'])->name('admin.login');
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/profile/update/{id}',[AdminController::class,'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/change/password/',[AdminController::class,'AdminChangePassword'])->name('change.password');
    Route::post('/change/password/save',[AdminController::class,'AdminChangePasswordSave'])->name('save.change.password');

    Route::controller(BrandController::class)->group(function (){
        Route::get('/add/brand','addBrand')->name('add.brand');
        Route::post('/store/brand','storeBrand')->name('store.brand');
        Route::get('/all/brand','allBrand')->name('all.brand');
        Route::get('/delete/brand/{id}','deleteBrand')->name('delete.brand');
        Route::get('/edit/brand/{id}','editBrand')->name('edit.brand');
        Route::post('/update/brand/{id}','updateBrand')->name('update.brand');
    });
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/add/category','addCategory')->name('add.category');
        Route::post('/store/category','storeCategory')->name('store.category');
        Route::get('/all/category','allCategory')->name('all.category');
        Route::get('/delete/category/{id}','deleteCategory')->name('delete.category');
        Route::get('/edit/category/{id}','editCategory')->name('edit.category');
        Route::post('/update/category/{id}','updateCategory')->name('update.category');
    });
    Route::controller(SubCategoryController::class)->group(function (){
        Route::get('/add/sub-category','addSubCategory')->name('add.sub.category');
        Route::get('/all/sub-category','allSubCategory')->name('all.sub.category');
        Route::post('/store/sub-category','storeSubCategory')->name('store.sub.category');
        Route::get('/edit/sub-category/{id}','editSubCategory')->name('edit.sub.category');
        Route::post('/update/sub-category/{id}','updateSubCategory')->name('update.sub.category');
        Route::get('/delete/sub-category/{id}','deleteSubCategory')->name('delete.sub.category');
    });

    Route::controller(AdminController::class)->group(function (){
        Route::get('/inactive/vendor','inactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor','activeVendor')->name('active.vendor');
        Route::get('/active/vendor/details/{id}','activeVendorDetails')->name('active.vendor.details');
        Route::get('/inactive/vendor/details/{id}','inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/update/vendor/status/{id}','updateVendorStatus')->name('update.vendor.status');
      });
});

Route::get('/vendor/login',[VendorController::class,'vendorLogin'])->name('vendor.login');
Route::get('/become/vendor',[VendorController::class,'becomeVendor'])->name('become.vendor');
Route::post('/register/vendor',[VendorController::class,'registerVendor'])->name('register.vendor');
Route::middleware(['auth','role:vendor'])->prefix('vendor')->group(function (){
    Route::controller(VendorController::class)->group(function (){
        Route::get('/dashboard','VendorDashboard')->name('vendor.dashboard');
        Route::get('/logout','VendorLogout')->name('vendor.logout');
        Route::get('/profile','VendorProfile')->name('vendor.profile');
        Route::post('/update/profile/{id}','UpdateVendorProfile')->name('update.vendor.profile');
        Route::post('/update/profile/{id}','UpdateVendorProfile')->name('update.vendor.profile');
        Route::get('/change/password/','VendorChangePassword')->name('vendor.change.password');
        Route::post('/change/password/save/','VendorChangePasswordSave')->name('vendor.change.password.save');

    });
});
