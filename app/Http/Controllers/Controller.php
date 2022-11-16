<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view(Request $request){
        if(Auth::check()){
            if(Auth::user()->position == 'Super Admin - Admin Staff'){
                return view('admin.homeAdmin', ['attendances'=> $attendance = Attendance::all()]);
            }else if(Auth::user()->position != 'Super Admin - Admin Staff'){
                return view('user.home', ['attendances'=> $attendance = Attendance::all()]);
            }
        }else{
            return view('user.login');
        }
    }

    public function login(Request $request){
        return view('user.login');
    }
}
