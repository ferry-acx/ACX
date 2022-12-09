<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Validator;
use Hash;

use App\Http\Middleware\forceLogout;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('forceLogout');
    }

    public function sessionExpired($id)
    {
        $user = User::findOrFail($id);

        if ($attendance = Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->where('user_id',$user->id)->first()){
                $attendance->task = "SESSION EXPIRED";
                $attendance->project = "SESSION EXPIRED";
                $attendance->location = "SESSION EXPIRED";
                $attendance->time_out = Carbon::now()->endOfDay()->format('g:i A'); //23:59:00
                
                $end = Carbon::parse($attendance->time_out);
                $start = Carbon::parse($attendance->time_in);

                $length = $start->diffInSeconds($end);

                $attendance->total_time = gmdate('H:i:s',$length);
                $save = $attendance->save();
        }
    }
    
    public function check(Request $request)
    {  
        $inputVal = $request->all();
   
        $this->validate($request, [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('username' => $inputVal['username'], 'password' => $inputVal['password']))){
                if ($employee = User::where('username',request('username'))->first()){
                    //dd(date('Y-m-d H:i:s'));exit;
                    if (Hash::check($request->password, $employee->password)) {
                            if (!Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->where('user_id',$employee->id)->first()){
                                $attendance = new Attendance;
                                $attendance->user_id = $employee->id;
                                $attendance->time_in = Carbon::now()->format('g:i A');
                                $attendance->attendance_date = date("Y-m-d");
                                $attendance->save();

                            }else{
                                return redirect()->route('user.login')->with('error','You have already assigned your attendance before.');
                            }
                        } else {
                        return redirect()->route('user.login')->with('error', 'Failed to assign the attendance');
                    }
                }
                return redirect(url('user/home'))->with('success','You are now logged in successfully');
        }else{
            return redirect()->route('user.login')->with('error','Incorrect credentials');
        }
    }   
          
    

    public function index1()
    {
        $attendance = Attendance::all()->where('user_id','==', Auth::user()->id);
      
        return view('user.dashboard', [
            'attendances' => $attendance
        ]);
    }


    public function index2()
    {
        $attendance = Attendance::all();
      
        return view('user.home', [
            'attendances' => $attendance
        ]);
    }

    public function UpdateInfo(Request $request){
           
        $validator = \Validator::make($request->all(),[
            'username'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'position'=>'required',
            'password'=>'required',
            
        ]);

        if(!$validator->passes()){
            return back()->with('error', 'Incomplete fields');
        }else{
             $query = User::find(Auth::user()->id)->update([
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'position' => $request->position,
                'password' => Hash::make($request['password']),
             ]);

             if(!$query){
                 return back()->with('error','Profile Not Updated');
             }else{
                 return back()->with('success','Profile Updated');
             }
        }
    }


    public function editAttendance($id){

        $attendance = Attendance::findOrFail($id);
        $attendance->task = request('task');
        $attendance->project = request('project');
        $save = $attendance->save();

        if( $save ){
            return redirect()->back()->with('success','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong, failed to update');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update attendance info
    public function logout($id)
    {
        $user = User::findOrFail($id);

        if ($attendance = Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->where('user_id',$user->id)->first()){
                $attendance->task = request('task');
                $attendance->project = request('project');
                $attendance->location = request('location');
                $attendance->time_out = Carbon::now()->format('g:i A');
                
                $end = Carbon::parse($attendance->time_out);
                $start = Carbon::parse($attendance->time_in);

                $length = $start->diffInSeconds($end);

                $attendance->total_time = gmdate('H:i:s',$length);

                $save = $attendance->save();
        
                if( $save ){
                    Auth::logout();
                    return redirect('/');
                }else{
                    return redirect()->back()->with('error','Something went wrong, failed to request');
                }
            
        }
    }
}