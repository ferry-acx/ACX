<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   /**
     * Display a listing of the attendance.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::orderByDesc('updated_at')->get();
        return view('admin.attendance')->with(['attendances'=> $attendance]);
    }

    public function show2()
    {
        return view('admin.homeAdmin')->with(['attendances'=> Attendance::all()]);
    }

    public function assessment($id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->supervisor_ass = request('supervisor_ass');
        $save = $attendance->save();

        if( $save ){
            return back()->with('success', 'Assessment Submitted Successfully');
          }else{
            return back()->with('error', 'Assessment Submitted Failed');
          }
    }
    
}
