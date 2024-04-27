<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\HouseRentalController;
use App\Http\Controllers\RentalReviewController;

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

Route::resource('/rentals', HouseRentalController::class);

//review
Route::post('/review/{id}', [RentalReviewController::class, 'review']);
Route::post('/review/edit/{id}', [RentalReviewController::class, 'edit']);
Route::delete('/review/delete/{id}', [RentalReviewController::class, 'delete']);



//for testing purposes dont mind this

use App\Models\User;

Route::get('/user', function () {
    return User::all();
});


Route::get('/token', function () {
    return csrf_token(); 
});
