<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        $request->validate([
            'review' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $room = $user->gender == 'L'
            ? DB::table('kamar_pria')->where('email', $user->email)->first()
            : DB::table('kamar_perempuan')->where('email', $user->email)->first();

        if ($room) {
            Review::create([
                'id_user' => $user->id_user,
                'nomor_kamar' => $room->nomor_kamar,
                'review' => $request->input('review'),
            ]);

            return redirect()->route('my_room')->with('success', 'Review submitted successfully.');
        } else {
            return redirect()->route('my_room')->with('error', 'Room not found.');
        }
    }
}
