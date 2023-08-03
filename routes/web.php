<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/login', [DashboardController::class, 'login'])->name('login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Dashboard routes for each role


// Include the admin routes
Route::group(
    [
        'middleware' => ['web', 'auth', 'role:admin'],
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
    include base_path('routes/admin.php');
});

// Include the event planner routes
Route::group(
    [
        'middleware' => ['web', 'auth', 'role:eventplanner'], 
        'prefix' => 'eventplanner', 
        'as' => 'eventplanner.'
    ], function () {
    include base_path('routes/eventplanner.php');
});

// Include the vendor routes
Route::group(
    [
        'middleware' => ['web', 'auth', 'role:vendor'], 
        'prefix' => 'vendor', 
        'as' => 'vendor.'
], function () {
    include base_path('routes/vendor.php');
});

// Include the user routes
Route::group(
    [
        'middleware' => ['web', 'auth', 'role:user'], 
        'prefix' => 'user', 
        'as' => 'user.'
], function () {
    include base_path('routes/user.php');
});