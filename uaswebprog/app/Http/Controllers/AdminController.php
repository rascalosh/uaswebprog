<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\User;
Use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        
        if(Auth::id()){
            $is_admin = Auth::user()->is_admin;

            if($is_admin){
                return view('admin-dashboard');
            }

            else{
                return view('dashboard');
            }
        }
    }
}
