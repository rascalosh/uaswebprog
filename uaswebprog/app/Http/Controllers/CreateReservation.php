<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CreateReservation extends Controller
{
    public function create(Request $request){

        $user = Auth::user();

        Validator::make($request->all(), [
            'start_date' => ['required', 'date'],
            'nomor_kamar' => ['required', 'string'],
            'gender' => ['required', 'string']
        ])->validate();

        User::where('id_user', $user->id_user)
            ->update(['is_reserving' => TRUE]);

        Reservation::create([
            'id_user' => $user->id_user,
            'nomor_kamar' => $request->input('nomor_kamar'),
            'gender' => $request->input('gender'),
            'start_date' => $request->input('start_date')
        ]);

        return redirect()->route('reserve-room');
    }
}
