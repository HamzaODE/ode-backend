<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/dashboard', [DashboardController::class, 'vendorDashboard'])->name('dashboard');