<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Attendance;
use Carbon\Carbon;
use Validator;
use Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
     public function login(Request $request)
     {  
        $inputVal = $request->all();
   
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('username' => $inputVal['username'], 'password' => $inputVal['password']))){
            
                        if ($employee = User::where('username',request('username'))->first()){
                            //dd(date('Y-m-d H:i:s'));exit;
                            if (Hash::check($request->password, $employee->password)) {
                                    if (!Attendance::where('attendance_date',date("Y-m-d"))->where('user_id',$employee->id)->first()){
                                        $attendance = new Attendance;
                                        $attendance->user_id = $employee->id;
                                        $attendance->time_in = Carbon::now()->format('g:i');
                                        $attendance->time_out = Carbon::now()->format('g:i');
                                        $attendance->attendance_date = date("Y-m-d");
                                        $attendance->save();

                                    }else{
                                        return redirect()->route('login')->with('error','You have already assigned your attendance before.');
                                    }
                                } else {
                                return redirect()->route('login')->with('error', 'Failed to assign the attendance');
                            }
                        }
            
            return redirect()->route('login')
                ->with('error','Username & Password are incorrect.');
        }     
    }
}
