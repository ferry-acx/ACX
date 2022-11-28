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
        $attendance = Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
        ->groupBy(DB::raw("user_id"))
        ->get();
        $employees= User::orderBy("updated_at","desc")->get();
        $employee_names = array();
        $ids = array();
        foreach ($employees as $single_employee) {
            array_push($employee_names,$single_employee->first_name);
            array_push($ids,$single_employee->id);

        }
        \Log::info(date('m/d/Y'));
        return view('admin.reports')->with(['employees' => $employee_names, 'attendances'=> $attendance, 'ids' => $ids,'dates'=> array(date('Y-m-d'),date('Y-m-d'))]);
    }

    public function displayReportsByDate(Request $request)
    {

        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $attendance = Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
        ->whereBetween('attendance_date', [$start_date, $end_date])
        ->groupBy(DB::raw("user_id"))
        ->get();
        $employees= User::orderBy("updated_at","desc")->get();
        $employee_names = array();
        $ids = array();
        foreach ($employees as $single_employee) {
            array_push($employee_names,$single_employee->first_name);
            array_push($ids,$single_employee->id);

        }

        //\Log::info(array($start_date,$end_date));
        return view('admin.reports')->with(['employees' => $employee_names,'ids' => $ids, 'attendances'=> $attendance,'dates'=> array($start_date,$end_date)]);
    }


    public function display()
    {
        return view('admin.reports_all');
    }

    public function displayAllReports(Request $request)
    {   
        switch($request->option){
            case 'today':
                $attendance = Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->get();
                break;
            case 'month':
                $attendance = Attendance::whereMonth('attendance_date', Carbon::now()->month)->get();
                break;
            case 'all':
                $attendance = Attendance::orderByDesc('updated_at')->get();
                break;
            default:
            $attendance = Attendance::where('attendance_date',Carbon::now()->format('Y-m-d'))->get();
        }
        return view('admin.reports_all')
        ->with(['attendances'=> $attendance]);
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
        //\Log::info($times);


        return json_encode($times);

    }
    
}