<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Report;
use App\Models\User;
use App\Http\Controllers\ReportExport;
use DB;
use Carbon\Carbon;

use PDF;

class ReportsController extends Controller
{
    public function show()
    {
        return view('admin.reports');
    }

    public function displayReports()
    {
        $attendance = Attendance::all();
        return view('admin.reports')->with(['attendances'=> $attendance]);
    }

    public function display()
    {
        return view('admin.reportsv2');
    }

    public function displayReportsV2()
    {
        $attendance = Attendance::all();
        $employees= User::orderBy("updated_at","desc")->get();
        $employee_names = array();
        $ids = array();
        foreach ($employees as $single_employee) {
            array_push($employee_names,$single_employee->first_name);
            array_push($ids,$single_employee->id);

        }

        return view('admin.reportsv2')->with(['employees' => $employee_names, 'attendances'=> $attendance, 'ids' => $ids]);
    }

    public function exportpdf(){
        $data = Report::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('dataemployee-pdf');
        return $pdf->download('data.pdf');
    }

    public function recordsfilter(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $times =  DB::table('attendances')
                ->whereBetween('attendance_date', [$start_date, $end_date])
                ->where('user_id','=', $request->user_id)
                ->selectRaw('SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum')
                ->get();
        \Log::info($times);


        return json_encode($times);

    }
}
