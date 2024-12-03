<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CreateReservation extends Controller
{
    public function create(Request $request){

        $user = Auth::user();

        Validator::make($request->all(), [
            'room' => ['required', 'string'],
            'gender' => ['required', 'string', 'in:L,P']
        ])->validate();

        DB::table('users')
                ->where('id_user', $user->id_user)
                ->update(['is_reserving' => TRUE]);

        Reservation::create([
            'id_user' => $user->id_user,
            'nomor_kamar' => $request->room,
            'gender' => $request->gender
        ]);

        return redirect()->route('dashboard');
    }
}
