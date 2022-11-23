<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Attendance;
use PDF;
use DB;
use Carbon\Carbon;

class PDFController extends Controller {
    

    public function show()
    {
        return view('admin.reports');
    }

    public function generatePDF(){

        //kinda working - per week only
        $start_date = Carbon::now()->startOfWeek()->format('Y-m-d');
        $end_date = Carbon::now()->endOfWeek()->format('Y-m-d');

        $pdf = PDF::loadView('admin.myPDF', [
            
            'attendances' => Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
            ->whereBetween('attendance_date', [$start_date, $end_date])
            ->groupBy(DB::raw("user_id"))
            ->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');
        
        return $pdf->download('Attendance Report.pdf');

    }


    // 15 days
    public function generatePDF1(){

        $date = Carbon::now()->subDays(15);

        $pdf = PDF::loadView('admin.myPDF', [
            'attendances' => Attendance::where('created_at', '>=', $date)->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');
        
        return $pdf->download('Attendance Report-15 Days.pdf');

    }



    // whole month
    public function generatePDF2(){

        $pdf = PDF::loadView('admin.myPDF', [
            'attendances' => Attendance::whereMonth('created_at', Carbon::now()->month)->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');
        
        return $pdf->download('Attendance Report-Month.pdf');

    }


    

    // whole year
    public function generatePDF3(){

        $pdf = PDF::loadView('admin.myPDF', [
            'attendances' => Attendance::whereYear('created_at', Carbon::now()->year)->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');
        
        return $pdf->download('Attendance Report-Year.pdf');

    }

}