<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroyReport($id){

        $report = Pelaporan::onlyTrashed()->find($id);
    
        $report->forceDelete();

        return redirect()->back()->with('success', 'Report Has Been Deleted..');
    }
}
