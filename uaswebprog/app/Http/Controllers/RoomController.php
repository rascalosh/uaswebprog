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
        $reports = $user->reports()->withTrashed()->get();
        $guests = $user->guests()->withTrashed()->get();
        $gender = $user->gender;

        if ($gender == 'L') {
            $room = $user->maleRoom;
        } elseif ($gender == 'P') {
            $room = $user->femaleRoom;
        }

        if ($room) {
            $averageRating = DB::table('reviews')
                ->where('nomor_kamar', $room->nomor_kamar)
                ->avg('review');
        } else {
            $averageRating = null;
        }

        return view('user.my-room', compact('room', 'averageRating', 'guests', 'reports'));
    }
}
