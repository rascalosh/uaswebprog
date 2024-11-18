<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CreateGuest extends Controller
{
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'guest_name' => ['required', 'string', 'max:255'],    
            'room' => ['required', 'string', 'min:2', 'max:2'],
            'gender' => ['required', 'string', 'in:L,P'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'integer', 'min:1'],
            'relation' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'email', 'max:255']
        ])->validate();

        Guest::create([
            'guest_name' => $request['guest_name'],
            'nomor_kamar' => $request['room'],
            'gender' => $request['gender'],
            'guest_amount' => $request['amount'],
            'visit_date' => $request['date'],
            'relation' => $request['relation'],
            'email_user' => $request['user_email']
        ]);

        return view('user.my-room');

        // dd($request->all());
    }
}
