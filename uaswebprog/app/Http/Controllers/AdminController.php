<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelaporan;
use App\Mail\ReportResolved;
use App\Mail\GuestResolved;
use App\Mail\ReservationRejected;
use App\Mail\ReservationAccepted;
use App\Models\Guest;
use App\Models\KamarPria;
use App\Models\KamarPerempuan;
use App\Models\Reservation;
use App\Models\TipeKamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $is_admin = Auth::user()->is_admin;

            if ($is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                $imagesPria = File::files(public_path('images/KamarPria'));
                return redirect()->route('dashboard', compact('imagesPerempuan', 'imagesPria'));
            }
        }

        return redirect()->route('login');
    }

    public function adminShow()
    {

        if (Auth::id()) {
            $is_admin = Auth::user()->is_admin;

            if ($is_admin) {
                return view('profile.admin-show');
            } else {
                return redirect()->back();
            }
        }
    }

    public function manage_rooms_pria()
    {

        $is_admin = Auth::user()->is_admin;

        if (!$is_admin) return redirect()->back();

        $data = DB::table('kamar_pria')->get();
        return view('admin.manage_rooms_pria', compact('data'));
    }

    public function manage_rooms_perempuan()
    {

        $is_admin = Auth::user()->is_admin;

        if (!$is_admin) return redirect()->back();

        $data = DB::table('kamar_perempuan')->get();
        return view('admin.manage_rooms_perempuan', compact('data'));
    }

    public function add_room_images()
    {

        $is_admin = Auth::user()->is_admin;

        if (!$is_admin) return redirect()->back();

        return view('admin.add_room_images');
    }

    public function manage_reservations()
    {
        $reservations = Reservation::all();

        return view('admin.manage_reservations', compact('reservations'));
    }

    public function manage_payments()
    {
        // $maleOccupants = DB::table('kamar_pria')
        // ->join('users', 'kamar_pria.id_user', '=', 'users.id_user')
        // ->whereNotNull('kamar_pria.id_user')
        // ->select('users.id_user as id_user', 'users.deadline_bayar', 'kamar_pria.nomor_kamar', 'kamar_pria.tipe_kamar')
        // ->orderBy('users.deadline_bayar', 'asc')
        // ->get();

        // $femaleOccupants = DB::table('kamar_perempuan')
        // ->join('users', 'kamar_perempuan.id_user', '=', 'users.id_user')
        // ->whereNotNull('kamar_perempuan.id_user')
        // ->select('users.id_user as id_user', 'users.deadline_bayar', 'kamar_perempuan.nomor_kamar', 'kamar_perempuan.tipe_kamar')
        // ->orderBy('users.deadline_bayar', 'asc')
        // ->get();

        $femaleOccupants = KamarPerempuan::with('user')
        ->whereNotNull('id_user')
        ->get()
        ->sortBy('user.deadline_bayar');

        // Fetch male occupants
        $maleOccupants = KamarPria::with('user')
        ->whereNotNull('id_user')
        ->get()
        ->sortBy('user.deadline_bayar');

        return view('admin.manage_payments', compact('maleOccupants', 'femaleOccupants'));
    }

    public function updateEmailPria(Request $request, $nomor_kamar)
    {
        if ($request->input('clear_email')) {
            // Clear the email
            DB::table('kamar_pria')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => null, 'full_name' => null]);
        } else {

            $request->validate([
                'email' => 'required|email|unique:kamar_pria|unique:kamar_perempuan'
            ]);

            DB::table('kamar_pria')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => $request->input('email')]);

            DB::table('kamar_pria')
                ->where('nomor_kamar', $nomor_kamar)
                ->join('users', 'users.email', '=', 'kamar_pria.email')
                ->update(['kamar_pria.full_name' => DB::raw('users.full_name')]);
        }

        return redirect()->back();
    }

    public function updateEmailPerempuan(Request $request, $nomor_kamar)
    {

        if ($request->input('clear_email')) {
            // Clear the email
            DB::table('kamar_perempuan')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => null, 'full_name' => null]);
        } else {

            $request->validate([
                'email' => 'required|email|unique:kamar_perempuan|unique:kamar_pria',
            ]);

            DB::table('kamar_perempuan')
                ->where('nomor_kamar', $nomor_kamar)
                ->update(['email' => $request->input('email')]);

            DB::table('kamar_perempuan')
                ->where('nomor_kamar', $nomor_kamar)
                ->join('users', 'users.email', '=', 'kamar_perempuan.email')
                ->update(['kamar_perempuan.full_name' => DB::raw('users.full_name')]);
        }

        return redirect()->back();
    }
    
    // public function add_images(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'image' => ['required', 'image', 'mimes:jpeg,png,jpg','max:2048'],
    //         'jenis_kos' => ['required', 'string', 'max:20']
    //     ])->validate();

    //     $folder = public_path('images/' . $request['jenis_kos']);

    //     $filename = uniqid() . '.' . $request['image']->getClientOriginalExtension();

    //     $request['image']->move($folder, $filename);

    //     return redirect()->back();
    // }
    public function dashboard()
    {
        // Fetch guests data from the database
        $guests = Guest::withTrashed()->get();
        $reports = Pelaporan::all();

        // Pass the guests data to the view
        return view('admin-dashboard', ['guests' => $guests, 'reports' => $reports]);
    }

    public function destroyGuest($id)
    {

        $guest = Guest::onlyTrashed()->findOrFail($id);

        $guestDetails = [
            'guest_name' => $guest->guest_name,
            'nomor_kamar' => $guest->nomor_kamar,
            'gender' => $guest->gender,
            'guest_amount' => $guest->guest_amount,
            'visit_date' => $guest->visit_date,
            'relation' => $guest->relation,
            'user_email' => $guest->user->email
        ];

        Mail::to($guestDetails['user_email'])->send(new GuestResolved($guestDetails));
        // Delete the guest from the database
        $guest->forceDelete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Guest deleted successfully.');
    }

    public function destroyReport($id)
    {   
        $report = Pelaporan::findOrFail($id);

        // Prepare email data
        $reportDetails = [
            'full_name' => $report->full_name,
            'nomor_kamar' => $report->nomor_kamar,
            'gender_kamar' => $report->gender_kamar,
            'tanggal' => $report->tanggal,
            'desc_pelaporan' => $report->desc_pelaporan,
            'user_email' => $report->user->email
        ];
        
        // Send email
        Mail::to($reportDetails['user_email'])->send(new ReportResolved($reportDetails));
    
        $report->delete(); // Soft Deletes

        return redirect()->back()->with('success', 'Report Has Been Resolved..');
        
    }

    public function search_email(Request $request){
        $user = User::where('email', $request->user_email)->first();

        return response()->json($user ?: null);
    }

    public function update_reservation(Request $request)
    {

        Validator::make($request->all(), [
            'reservation_id' => ['required', 'integer'],
            'action' => ['required', 'string']
        ])->validate();

        $reservation = Reservation::where('reservation_id', $request->reservation_id)->first();

        if ($request->input('action') === "reject") {
            User::where('id_user', $reservation->id_user)
                ->update(['is_reserving' => FALSE]);

            Mail::to($reservation->user->email)->send(new ReservationRejected($reservation));
        }

        else{
            
            $gender = $reservation->gender;

            $table = ($gender == 'P') ? 'kamar_perempuan' : 'kamar_pria';

            DB::table($table)
                ->where('nomor_kamar', $reservation->nomor_kamar)
                ->update(['id_user' => $reservation->id_user]);

            User::where('id_user', $reservation->id_user)
                ->update(['is_reserving' => FALSE, 'has_room' => TRUE, 'deadline_bayar' => $reservation->start_date->addMonth()]);

            Mail::to($reservation->user->email)->send(new ReservationAccepted($reservation));
        }

        DB::table('reservations')->where('reservation_id', $request->reservation_id)->delete();

        return redirect()->back();

        //     $request->validate([
        //         'email' => 'required|email|unique:kamar_perempuan|unique:kamar_pria',
        //     ]);

        //     DB::table('kamar_perempuan')
        //         ->where('nomor_kamar', $nomor_kamar)
        //         ->update(['email' => $request->input('email')]);

        //     DB::table('kamar_perempuan')
        //         ->where('nomor_kamar', $nomor_kamar)
        //         ->join('users', 'users.email', '=', 'kamar_perempuan.email')
        //         ->update(['kamar_perempuan.full_name' => DB::raw('users.full_name')]);
        // }

        // return redirect()->back();
    }

    public function update_payment(Request $request)
    {
        
        Validator::make($request->all(), [
            'duration' => ['required', 'integer', 'min:1'],
            'id_user' => ['required', 'integer', 'exists:users,id_user']
        ])->validate();

        $user = User::find($request->id_user);

        $newDeadline = Carbon::parse($user->deadline_bayar)->addMonths((int) $request->duration);

        $user->update(['deadline_bayar' => $newDeadline]);

        return redirect()->back();
    }

    public function revoke_ownership(Request $request)
    {
        Validator::make($request->all(), [
            'id_user' => ['required', 'integer', 'exists:users,id_user']
        ])->validate();

        $user = User::find($request->id_user);

        $user->maleRoom()->update(['id_user' => null]);
        $user->femaleRoom()->update(['id_user' => null]);
        $user->guests()->forceDelete();

        $user->update(['has_room' => FALSE]);

        return redirect()->back();
    }

    public function prices()
    {
        $tipeKamar = TipeKamar::all();
        return view('admin.prices', compact('tipeKamar'));
    }

    public function update_prices(Request $request)
    {
        Validator::make($request->all(), [
            'price' => ['required', 'integer'],
            'tipe_kamar' => ['required', 'in:dalam,luar']
        ])->validate();

        $isKamarMandi = $request->tipe_kamar == "dalam" ? 1 : 0;

        TipeKamar::find($isKamarMandi)->update(['harga' => $request->price]);

        return redirect()->back();
    }
 }
