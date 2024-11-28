<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CreateReservation extends Controller
{
    public function create(Request $request){

        Validator::make($request->all(), [
            'room' => ['required', 'string', 'min:2', 'max:2'],
            'user_email' => ['required', 'email', 'max:255']
        ])->validate();

        DB::table('users')
                ->where('email', $request->input('user_email'))
                ->update(['is_reserving' => $request->input('room')]);

        return redirect()->route('dashboard');
    }
}
