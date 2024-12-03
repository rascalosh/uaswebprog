<?php

namespace App\Http\Controllers;
use App\Models\Pelaporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CreateReport extends Controller
{
    public function create(Request $request)
    {
        $email = Auth::user()->is_admin;

        Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],    
            'room' => ['required', 'string', 'min:2', 'max:2'],
            'gender' => ['required', 'string', 'in:L,P'],
            'date' => ['required', 'date'],
            'desc_pelaporan' => ['required', 'string', 'max:255']
        ])->validate();

        Pelaporan::create([
            'full_name' => $request['full_name'],
            'nomor_kamar' => $request['room'],
            'gender_kamar' => $request['gender'],
            'tanggal' => $request['date'],
            'desc_pelaporan' => $request['desc_pelaporan'],
            'user_email' => $email
        ]);

        return redirect()->route('my_room');
    }
}
