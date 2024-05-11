<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\HouseRentalController;
use App\Http\Controllers\RentalReviewController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantApplicationController;
use App\Models\TenantApplication;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TenantController::class, 'getTenants']);

//login
Route::get('/landowner/login', [AuthManager::class, 'ownerLogin'])->name('ownerLogin');
Route::post('/landowner/login', [AuthManager::class, 'ownerLoginPost'])->name('ownerLogin.post');
Route::get('/landowner/signup', [AuthManager::class, 'ownerSignup'])->name('ownerSignup');
Route::post('/landowner/signup', [AuthManager::class, 'ownerSignupPost'])->name('ownerSignup.post');
Route::get('landowner/logout', [AuthManager::class, 'ownerLogout'])->name('ownerLogout');

Route::get('landowner/main/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('admin');
Route::get('landowner/main/listings', [HouseRentalController::class, 'index'])->name('listings');
Route::get('landowner/main/addRentals', [HouseRentalController::class, 'create'])->name('addRentals');
Route::post('landowner/main/addRentals', [HouseRentalController::class, 'store'])->name('addRentals.post');
Route::get('landowner/main/editRentals/{id}', [HouseRentalController::class, 'show'])->name('editRentals');
Route::post('landowner/main/editRentals/{id}', [HouseRentalController::class, 'update'])->name('editRentals.post');
Route::get('landowner/main/deleteRentals/{id?}', [HouseRentalController::class, 'destroy'])->name('deleteRentals');




Route::post('/login', [AuthManager::class, 'loginPost']);
Route::post('/signup', [AuthManager::class, 'signupPost']);
Route::get('/email/verify/{id}/{hash}', [AuthManager::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

//house rental
//sawing resources HAHAHHAHAH di rin nagamit tinamad na eh 
// Route::resource('/rentals', HouseRentalController::class);


//review
Route::post('/review/{id}', [RentalReviewController::class, 'review']);
Route::post('/review/edit/{id}', [RentalReviewController::class, 'edit']);
Route::delete('/review/delete/{id}', [RentalReviewController::class, 'delete']);

//tenant application 
Route::get('/landowner/applications', [TenantApplicationController::class, 'getTenantApplication'])->name('applications');
Route::post('/tenant/applications/{id}/apply', [TenantApplicationController::class, 'apply']);
Route::get('/landowner/applications/{id}/accept', [TenantApplicationController::class, 'accept'])->name('application.accept');
Route::get('/landowner/applications/{id}/reject', [TenantApplicationController::class, 'reject'])->name('application.reject');

//tenant mangament 




//for testing purposes dont mind this

use App\Models\User;

Route::get('/user', function () {
    return User::all();
});


Route::get('/token', function () {
    return csrf_token(); 
});
