<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (Auth::check()) {
            $is_admin = Auth::user()->is_admin;

            // Redirect to admin dashboard if user is an admin
            if ($is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // Redirect logged-in users to /dashboard
            return redirect()->route('dashboard');
        }

        // Guest user sees the welcome page
        return view('welcome');
    }
}
