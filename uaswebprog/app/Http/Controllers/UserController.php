<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroyReport($id){

        $report = Pelaporan::onlyTrashed()->find($id);
    
        $report->forceDelete();

        return redirect()->back()->with('success', 'Report Has Been Deleted..');
    }

    public function cancel_reservation(){
        
        User::find(Auth::user()->id_user)->update(['is_reserving' => FALSE]);

        Reservation::where('id_user', Auth::user()->id_user)->delete();

        return redirect()->back()->with('Success', 'Reservation Cancelled');
    }
}
