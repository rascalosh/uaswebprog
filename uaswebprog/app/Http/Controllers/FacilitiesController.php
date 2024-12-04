<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        return view('fasilitas'); 
    }
}
