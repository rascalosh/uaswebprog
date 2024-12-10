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
        $user = Auth::user();

        Validator::make($request->all(), [
            'room' => ['required', 'string', 'min:2', 'max:2'],
            'gender' => ['required', 'string', 'in:L,P'],
            'date' => ['required', 'date'],
            'desc_pelaporan' => ['required', 'string', 'max:255'],
            'proof' => ['nullable', 'image', 'mimes:jpeg,png,jpg','max:2048']
        ])->validate();

        $data = [
            'id_user' => $user->id_user,
            'full_name' => $user->full_name,
            'nomor_kamar' => $request['room'],
            'gender_kamar' => $request['gender'],
            'tanggal' => $request['date'],
            'desc_pelaporan' => $request['desc_pelaporan']
        ];

        if ($request->hasFile('proof')) {
            $proof = $request->file('proof');
            $imageName = $proof->getClientOriginalName();
            $proof->storeAs('public/images/ReportProofs', $imageName);
            $data['proof'] = $imageName;

            $folder = public_path('images/ReportProofs');

            // $filename = uniqid() . '.' . $request['proof']->getClientOriginalExtension();
            $filename = $proof->getClientOriginalName();

            $request['proof']->move($folder, $filename);
        }

        Pelaporan::create($data);

        return redirect()->route('my_room');
    }
}
