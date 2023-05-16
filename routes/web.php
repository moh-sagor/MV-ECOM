<?php
////////////////////////Admin////////////////
use App\Http\Controllers\Admin\AdminController;

//////////////////////Vendor////////////////
use App\Http\Controllers\Vendor\VendorController;


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

///////////////////////////////////////////////////
// Admin Routes//
///////////////////////////////////////////////////

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('admin/update/profile', [AdminController::class, 'updateprofile'])->name('admin.update.profile');
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

///////////////////////////////////////////////////
// Vendor Routes//
///////////////////////////////////////////////////

Route::middleware('auth', 'role:vendor')->group(function () {
    Route::get('vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
});



require __DIR__ . '/auth.php';