<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function showMyRoom()
    {
        $user = Auth::user();
        $user = User::find($user->id_user);
        $reports = $user->reports()->withTrashed()->get();
        $guests = $user->guests()->get();

        // if ($gender == 'L') {
        //     $room = $user->maleRoom;
        // } elseif ($gender == 'P') {
        //     $room = $user->femaleRoom;
        // }

        $room = $user->maleRoom;
        $roomGender = 'L';

        if($room == NULL){
            $room = $user->femaleRoom;
            $roomGender = 'P';
        }

        if ($room) {
            $averageRating = DB::table('reviews')
                ->where('nomor_kamar', $room->nomor_kamar)
                ->avg('review');
        } else {
            $averageRating = null;
        }

        return view('user.my-room', compact('room', 'roomGender', 'averageRating', 'guests', 'reports'));
    }
}
