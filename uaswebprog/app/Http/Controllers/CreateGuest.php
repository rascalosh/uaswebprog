<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CreateGuest extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        Validator::make($request->all(), [
            'guest_name' => ['required', 'string', 'max:255'],    
            'room' => ['required', 'string'],
            'gender' => ['required', 'string', 'in:L,P'],
            'date' => ['required', 'date'],
            'duration' => ['required', 'integer', 'min:1'],
            'amount' => ['required', 'integer', 'min:1'],
            'relation' => ['required', 'string', 'max:255']
        ])->validate();

        $end_date = Carbon::parse($request['date'])->addDays((int) $request['duration']);

        Guest::create([
            'id_user' => $user->id_user,
            'guest_name' => $request['guest_name'],
            'nomor_kamar' => $request['room'],
            'gender' => $request['gender'],
            'guest_amount' => $request['amount'],
            'visit_date' => $request['date'],
            'end_date' => $end_date,
            'relation' => $request['relation'],
        ]);

        return redirect()->route('my_room');

        // dd($request->all());
    }
}
