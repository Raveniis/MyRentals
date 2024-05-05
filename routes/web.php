<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\HouseRentalController;
use App\Http\Controllers\RentalReviewController;
use App\Http\Controllers\AuthManager;
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
Route::post('/login', [AuthManager::class, 'loginPost']);
Route::post('/signup', [AuthManager::class, 'signupPost']);
Route::get('/email/verify/{id}/{hash}', [AuthManager::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

//house rental
Route::resource('/rentals', HouseRentalController::class);

//review
Route::post('/review/{id}', [RentalReviewController::class, 'review']);
Route::post('/review/edit/{id}', [RentalReviewController::class, 'edit']);
Route::delete('/review/delete/{id}', [RentalReviewController::class, 'delete']);

//tenant application 
Route::post('/tenant/applications/{id}/apply', [TenantApplicationController::class, 'apply']);
Route::get('/tenant/applications', [TenantApplicationController::class, 'getTenantApplication']);
Route::get('/tenant/applications/{id}/accept', [TenantApplicationController::class, 'accept']);
Route::get('/tenant/applications/{id}/reject', [TenantApplicationController::class, 'reject'] );




//for testing purposes dont mind this

use App\Models\User;

Route::get('/user', function () {
    return User::all();
});


Route::get('/token', function () {
    return csrf_token(); 
});
