<?php
////////////////////////Admin////////////////
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

//////////////////////Vendor////////////////
use App\Http\Controllers\Vendor\VendorController;


use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('frontend.index');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
///////////////////////////////////////////////////
// User Routes//
///////////////////////////////////////////////////
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/profile/update', [UserController::class, 'updateuser'])->name('user.updateuser');
    Route::get('/dashboard/user/logout', [UserController::class, 'userlogout'])->name('user.logout');
});

///////////////////////////////////////////////////
// Admin Routes//
///////////////////////////////////////////////////

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('admin/change/password', [AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('admin/update/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
    Route::post('admin/update/profile', [AdminController::class, 'updateprofile'])->name('admin.update.profile');

    // ==============Brand Route=================
    Route::controller(BrandController::class)->group(function () {
        Route::get('/Brand/add', 'index')->name('brand.add');
        Route::post('/Brand/store', 'store')->name('brand.store');
        Route::get('/Brand/manage', 'manage')->name('brand.manage');
        Route::get('/Brand/edit/{id}', 'edit')->name('brand.edit');
        Route::post('/Brand/update/{id}', 'update')->name('brand.update');
        Route::get('/Brand/delete/{id}', 'delete')->name('brand.delete');

    });

    // ==============Category Route=================
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/Category/add', 'index')->name('category.add');
        Route::post('/Category/store', 'store')->name('category.store');
        Route::get('/Category/manage', 'manage')->name('category.manage');
        Route::get('/Category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/Category/update/{id}', 'update')->name('category.update');
        Route::get('/Category/delete/{id}', 'delete')->name('category.delete');

    });
    // ==============SubCategory Route=================
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/SubCategory/add', 'index')->name('subcategory.add');
        Route::post('/SubCategory/store', 'store')->name('subcategory.store');
        Route::get('/SubCategory/manage', 'manage')->name('subcategory.manage');
        Route::get('/SubCategory/edit/{id}', 'edit')->name('subcategory.edit');
        Route::post('/SubCategory/update/{id}', 'update')->name('subcategory.update');
        Route::get('/SubCategory/delete/{id}', 'delete')->name('subcategory.delete');

    });

});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

///////////////////////////////////////////////////
// Vendor Routes//
///////////////////////////////////////////////////

Route::middleware('auth', 'role:vendor')->group(function () {
    Route::get('vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::get('vendor/change/password', [VendorController::class, 'changePassword'])->name('vendor.change.password');
    Route::post('vendor/update/password', [VendorController::class, 'updatePassword'])->name('vendor.update.password');
    Route::post('vendor/update/profile', [VendorController::class, 'updateprofile'])->name('vendor.update.profile');
});

Route::get('vendor/login', [VendorController::class, 'login'])->name('vendor.login');




require __DIR__ . '/auth.php';