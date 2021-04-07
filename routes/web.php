<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Listing;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/bids', function () {
    if(request()->has('search')){
        $search = request()->get('search');
        $listings = Listing::where('title', 'like', '%'.$search.'%')->
        orWhere('status', 'like', '%'.$search.'%')->
        orWhere('breed', 'like', '%'.$search.'%')->paginate(20);
      }else{
        $listings = Listing::all();
      }
    return view('/bids')->with('listings',$listings);
});
Route::get('/bids/{id}', function ($id) {
    $listing = Listing::find($id);
    return view('/show-listing')->with('listing',$listing);
});
Route::patch('/approve/listing/{id}', [DashboardController::class, 'approveListing']);
Route::get('/listing/create', [DashboardController::class, 'createListing']);
Route::post('/listing/create', [DashboardController::class, 'storeListing']);
Route::post('/dashboard/create-user', [DashboardController::class, 'storeNewUser']);
Route::get('/dashboard/create-user', [DashboardController::class, 'createUser']);
Route::get('/dashboard/account', [DashboardController::class, 'editAccount']);
Route::get('/dashboard/account/user/{id}', [DashboardController::class, 'editUser']);
Route::delete('/dashboard/account/user/{id}', [DashboardController::class, 'deleteUser']);
Route::patch('/dashboard/account/update-password/{id}', [DashboardController::class, 'updatePassword']);
Route::patch('/dashboard/account/update-details/{id}', [DashboardController::class, 'updateDetails']);
Route::resource('/dashboard', DashboardController::class);

require __DIR__.'/auth.php';
