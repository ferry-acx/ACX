<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Http\Controllers\UserController;

class forceLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $midnight = Carbon::now()->endOfDay()->format('g:i A'); //23:59:59
  
        $check = Carbon::now()->format('g:i A');
        if(Auth::check()){

        
            if ($attendance = Attendance::where('user_id',Auth::user()->id)->first()){
            
                if ($check == $midnight)
                {
                    $attendance->task = "SESSION EXPIRED";
                    $attendance->project = "SESSION EXPIRED";
                    $attendance->location = "SESSION EXPIRED";
                    $attendance->time_out = $midnight;
                
                    $end = Carbon::parse($attendance->time_out);
                    $start = Carbon::parse($attendance->time_in);

                    $length = $start->diffInSeconds($end);

                    $attendance->total_time = gmdate('H:i:s',$length);
                    $save = $attendance->save();

                    Auth::logout();
                    //kailangan pa iclick ang refresh button
                    return redirect()->refresh()->with('error', 'Your session has expired.');
                }
            }
        }
        return $next($request);
    }
}