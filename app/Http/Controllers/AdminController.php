<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function check2(Request $request)
    {  
        $request->validate([
            'username' => 'required|exists:admins,username',
            'password' => 'required',
        ], [
            'username.exists'=>'This user does not exists on database',
        ]);
        
            $creds = $request->only('username','password');
    
        if(Auth::guard('admin')->attempt($creds) ){
                    return redirect(url('admin/homeAdmin'))->with('success','You are now logged in successfully');
                }else{
                    return redirect(url('admin/login'))->with('error','Incorrect credentials');
                }     
    }

    public function dataAtt()
    {
        return view('admin.homeAdmin')->with(['attendances'=> Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->get()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }

    public function UpdateProfile(Request $request){
           
        $validator = \Validator::make($request->all(),[
        'username'=>'required',
        'password'=>'required',
            
        ]);

        if(!$validator->passes()){
            return back()->with('error','Incomplete fields');
        }else{
            $query = Admin::find(Auth::guard('admin')->user()->id)->update([
                'username' => $request->username,
                'password' => Hash::make($request['password']),
             ]);

             if(!$query){
                 return back()->with('error','Profile Not Updated');
             }else{
                 return back()->with('success','Profile Updated');
             }
        }
    }
}