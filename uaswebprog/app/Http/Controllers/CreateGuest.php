<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CreateGuest extends Controller
{
    public function create(Request $request)
    {
        $email = Auth::user()->is_admin;

        Validator::make($request->all(), [
            'guest_name' => ['required', 'string', 'max:255'],    
            'room' => ['required', 'string'],
            'gender' => ['required', 'string', 'in:L,P'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'integer', 'min:1'],
            'relation' => ['required', 'string', 'max:255']
        ])->validate();

        Guest::create([
            'guest_name' => $request['guest_name'],
            'nomor_kamar' => $request['room'],
            'gender' => $request['gender'],
            'guest_amount' => $request['amount'],
            'visit_date' => $request['date'],
            'relation' => $request['relation'],
            'email_user' => $email
        ]);

        return redirect()->route('my_room');

        // dd($request->all());
    }
}
