<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function showMyRoom()
    {
        $user = Auth::user();
        $gender = $user->gender;

        if ($gender == 'L') {
            $room = DB::table('kamar_pria')->where('id_user', $user->id_user)->first();
        } elseif ($gender == 'P') {
            $room = DB::table('kamar_perempuan')->where('id_user', $user->id_user)->first();
        }

        if ($room) {
            $averageRating = DB::table('reviews')
                ->where('nomor_kamar', $room->nomor_kamar)
                ->avg('review');
        } else {
            $averageRating = null;
        }

        return view('user.my-room', compact('room', 'averageRating'));
    }
}
