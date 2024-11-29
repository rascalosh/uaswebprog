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
        $email = $user->email;
        $gender = $user->gender;

        if ($gender == 'L') {
            $room = DB::table('kamar_pria')->where('email', $email)->first();
        } elseif ($gender == 'P') {
            $room = DB::table('kamar_perempuan')->where('email', $email)->first();
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
