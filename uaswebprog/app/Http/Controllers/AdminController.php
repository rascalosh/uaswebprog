<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\User;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function adminShow(){
        
        if(Auth::id()){
            $is_admin = Auth::user()->is_admin;

            if($is_admin){
                return view('profile.admin-show');
            }

            else{
                return redirect()->back();
            }
        }
    }

    public function manage_rooms_pria(){

        $is_admin = Auth::user()->is_admin;

        if(!$is_admin) return redirect()->back();

        $data = DB::table('kamar_pria')->get();
        return view('admin.manage_rooms_pria', compact('data'));
    }
    
    public function manage_rooms_perempuan(){

        $is_admin = Auth::user()->is_admin;

        if(!$is_admin) return redirect()->back();

        $data = DB::table('kamar_perempuan')->get();
        return view('admin.manage_rooms_perempuan', compact('data'));
    }

    public function updateEmailPria(Request $request, $nomor_kamar)
    {
        if ($request->input('clear_email')) {
            // Clear the email
            DB::table('kamar_pria')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => null, 'full_name' => null]);
        }

        else{
        
        $request->validate([
            'email' => 'required|email|unique:kamar_pria|unique:kamar_perempuan'
        ]);

        DB::table('kamar_pria')
            ->where('nomor_kamar', $nomor_kamar)
            ->update(['email' => $request->input('email')]);
            
        DB::table('kamar_pria')
            ->where('nomor_kamar', $nomor_kamar)
            ->join('users', 'users.email', '=', 'kamar_pria.email')
            ->update(['kamar_pria.full_name' => DB::raw('users.full_name')]);
        }

        return redirect()->back();
    }

    public function updateEmailPerempuan(Request $request, $nomor_kamar)
    {

        if ($request->input('clear_email')) {
            // Clear the email
            DB::table('kamar_perempuan')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => null]);
        }

        else{
        
        $request->validate([
            'email' => 'required|email|unique:kamar_perempuan|unique:kamar_pria',
        ]);

        DB::table('kamar_perempuan')
            ->where('nomor_kamar', $nomor_kamar)
            ->update(['email' => $request->input('email')]);

        DB::table('kamar_perempuan')
            ->where('nomor_kamar', $nomor_kamar)
            ->join('users', 'users.email', '=', 'kamar_perempuan.email')
            ->update(['kamar_perempuan.full_name' => DB::raw('users.full_name')]);

        }

        return redirect()->back();
    }
}