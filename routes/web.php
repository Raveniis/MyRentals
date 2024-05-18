<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\HouseRentalController;
use App\Http\Controllers\RentalReviewController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantApplicationController;
use App\Models\HouseRental;
use App\Models\TenantApplication;

//authentication landowner
Route::get('/landowner/login', [AuthManager::class, 'ownerLogin'])->name('ownerLogin');
Route::post('/landowner/login', [AuthManager::class, 'ownerLoginPost'])->name('ownerLogin.post');
Route::get('/landowner/signup', [AuthManager::class, 'ownerSignup'])->name('ownerSignup');
Route::post('/landowner/signup', [AuthManager::class, 'ownerSignupPost'])->name('ownerSignup.post');
Route::get('logout', [AuthManager::class, 'ownerLogout'])->name('ownerLogout');

Route::group(['prefix' => '/landowner', 'middleware' => ['admin']], function () {

    //dashboard
    Route::get('main/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //listing
    Route::get('main/listings', [HouseRentalController::class, 'index'])->name('listings');
    Route::get('main/addRentals', [HouseRentalController::class, 'create'])->name('addRentals');
    Route::post('main/addRentals', [HouseRentalController::class, 'store'])->name('addRentals.post');
    Route::get('main/editRentals/{id}', [HouseRentalController::class, 'show'])->name('editRentals');
    Route::post('main/editRentals/{id}', [HouseRentalController::class, 'update'])->name('editRentals.post');
    Route::get('main/deleteRentals/{id?}', [HouseRentalController::class, 'destroy'])->name('deleteRentals');

    
    //profile
    Route::get('main/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('main/profile/update', [ProfileController::class, 'update'])->name('profile.post');

    
    //tenant application 
    Route::get('applications', [TenantApplicationController::class, 'getTenantApplication'])->name('applications');
    Route::get('applications/{id}/accept', [TenantApplicationController::class, 'accept'])->name('application.accept');
    Route::get('applications/{id}/reject', [TenantApplicationController::class, 'reject'])->name('application.reject');
    Route::get('applications/{id}/delete', [TenantApplicationController::class, 'delete'])->name('application.destroy');
    Route::get('applications/{id}/view', [TenantApplicationController::class, 'show'])->name('application.review');

    
    //tenant mangament 
    Route::get('tenants', [TenantController::class, 'getTenants'])->name('tenants');
    Route::get('tenants/show/{id}', [TenantController::class, 'show'])->name('tenants.show');
    Route::post('tenants/edit/{id}', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::get('tenants/remove/{id}', [TenantController::class, 'removeTenant'])->name('tenants.remove');
    Route::get('tenants/delete/{id}', [TenantController::class, 'delete'])->name('tenants.delete');
});

//authentication user
Route::get('/login', [AuthManager::class, 'login'])->name('userLogin');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('userLogin.post');;
Route::get('/signup', [AuthManager::class, 'signup'])->name('userRegister');
Route::post('/signup', [AuthManager::class, 'signupPost'])->name('userRegister.post');
// Route::get('/email/verify/{id}/{hash}', [AuthManager::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

//user views
Route::get('/', [HouseRentalController::class, 'getRentals'])->name('index');
Route::get('/houseRental/{id}', [HouseRentalController::class, 'viewRentals'])->name('houseRentals');

Route::get('/profile', [ProfileController::class, 'userProfile'])->name('userProfile');
Route::post('/profile/update', [ProfileController::class, 'updateUser'])->name('userProfile.post');

Route::get('/applicationStatus', [TenantApplicationController::class, 'userApplicationStatus'])->name('userApplication');

//review

Route::group(['middleware' => ['auth']], function () {
    //tenant
    Route::get('/tenant/applications/{id}', [TenantApplicationController::class, 'applicationForm'])->name('applicationForm');
    Route::post('/tenant/applications/{id}/apply', [TenantApplicationController::class, 'apply'])->name('applicationForm.post');

    
    Route::post('/review/{id}', [RentalReviewController::class, 'review']);
    Route::post('/review/edit/{id}', [RentalReviewController::class, 'edit']);
    Route::delete('/review/delete/{id}', [RentalReviewController::class, 'delete']);

    Route::get('/history', [TenantController::class, 'userTenant'])->name('userTenant');


});

//for testing purposes dont mind this
Route::get('/token', function () {
    return csrf_token(); 
});
