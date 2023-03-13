<?php

use App\Http\Controllers\sociallogin\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\VendorProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\frontend\FrontendController;

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

Route::get('/',[FrontendController::class,'index'])->name('/');

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
        Route::get('/get-subcategory-by-category/{id}','subCatByCatAjax');
    });
    Route::controller(ProductController::class)->group(function (){
        Route::get('/add/product','addProduct')->name('add.product');
        Route::get('/all/product','allProduct')->name('all.product');
        Route::post('/store/product','storeProduct')->name('store.product');
        Route::get('/edit/product/{id}','editProduct')->name('edit.product');
        Route::post('/update/product/{id}','updateProduct')->name('update.product');
        Route::get('/delete/product/{id}','deleteProduct')->name('delete.product');
        Route::get('/delete/multiimages/{id}','deleteMultiimages')->name('delete.multiimages');
        Route::get('/view/product/{id}','viewProduct')->name('view.product');
        Route::get('/status/product/{id}','statusProduct')->name('status.product');
        Route::post('/update/product-thumb/{id}','updateProductThumb')->name('update.product.thumb');
        Route::post('/update/product-multimage/','updateProductKultimg')->name('update.product.multimg');
    });

    Route::controller(AdminController::class)->group(function (){
        Route::get('/inactive/vendor','inactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor','activeVendor')->name('active.vendor');
        Route::get('/active/vendor/details/{id}','activeVendorDetails')->name('active.vendor.details');
        Route::get('/inactive/vendor/details/{id}','inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/update/vendor/status/{id}','updateVendorStatus')->name('update.vendor.status');
      });

    Route::controller(SliderController::class)->group(function (){
        Route::get('/all/slider','allSlider')->name('all.slider');
        Route::get('/create/slider','createSlider')->name('create.slider');
        Route::post('/store/slider','storeSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','editSlider')->name('edit.slider');
        Route::post('/update/slider/{id}','updateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}','deleteSlider')->name('delete.slider');
      });
    Route::controller(BannerController::class)->group(function (){
        Route::get('/all/banner','allBanner')->name('all.banner');
        Route::get('/create/banner','createBanner')->name('create.banner');
        Route::post('/store/banner','storeBanner')->name('store.banner');
        Route::get('/edit/banner/{id}','editBanner')->name('edit.banner');
        Route::post('/update/banner/{id}','updateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}','deleteBanner')->name('delete.banner');
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
    Route::controller(VendorProductController::class)->group(function (){
        Route::get('/add/vendor/product','addVendorProduct')->name('add.vendor.product');
        Route::get('/all/vendor/product','allVendorProduct')->name('all.vendor.product');
        Route::post('/store/vendor/product','storeVendorProduct')->name('store.vendor.product');
        Route::get('/get-subcategory-by-category/{id}','subCatByCatAjax');
        Route::get('/edit/vendor/product/{id}','editVendorProduct')->name('edit.vendor.product');
        Route::post('/update/vendor/product/{id}','updateVendorProduct')->name('update.vendor.product');
        Route::get('/delete/vendor/product/{id}','deleteVendorProduct')->name('delete.vendor.product');
        Route::get('/delete/vendor/multiimages/{id}','deleteVendorMultiimages')->name('delete.vendor.multiimages');
        Route::get('/view/vendor/product/{id}','viewVendorProduct')->name('view.vendor.product');
        Route::get('/status/vendor/product/{id}','statusVendorProduct')->name('status.vendor.product');
        Route::post('/update/vendor/product-thumb/{id}','updateVendorProductThumb')->name('update.vendor.product.thumb');
        Route::post('/update/vendor/product-multimage/','updateVendorProductKultimg')->name('update.vendor.product.multimg');
    });
});

//frontend routes

Route::controller(FrontendController::class)->group(function (){
    Route::get('/product/details/{id}/{slug}','productDetails');
    Route::get('/vendor/details/{id}','vendorDetails')->name('vendor.details');
    Route::get('/all/vendor/','allVendor')->name('all.vendor');
    Route::get('/product/category/{id}/{slug}','catWiseProduct');
    Route::get('/product/sub-category/{id}/{slug}','subCatWiseProduct');
});
