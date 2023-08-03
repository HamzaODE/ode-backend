<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'eventplanner':
                    return redirect()->route('eventplanner.dashboard');
                case 'vendor':
                    return redirect()->route('vendor.dashboard');
                case 'user':
                    return redirect()->route('user.dashboard');
                // Add cases for other roles if needed
                default:
                    return abort(403);
            }
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function index()
    {
        return view('home');
    }

    public function adminDashboard()
    {
        return view('admin.home');
    }

    public function eventPlannerDashboard()
    {
        return view('eventplanner.home');
    }

    public function vendorDashboard()
    {
        return view('vendor.home');
    }

    public function userDashboard()
    {
        return view('user.home');
    }

    // Add methods for other roles if needed
}
