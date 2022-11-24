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

    public function generatePDF(Request $request){

        switch($request->option){
            case 'week':
                $start=Carbon::now()->startOfWeek()->format('Y-m-d');
                $end=Carbon::now()->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $start=Carbon::now()->startOfMonth()->format('Y-m-d');
                $end=Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
            case 'year':
                $start=Carbon::now()->startOfYear()->format('Y-m-d');
                $end=Carbon::now()->endOfYear()->format('Y-m-d');
                break;
            default:
                $start=Carbon::now()->format('Y-m-d');
                $end=Carbon::now()->format('Y-m-d');
        }

        $pdf = PDF::loadView('admin.myPDF', [

            'attendances' => Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
            ->whereBetween('attendance_date', [$start, $end])
            ->groupBy(DB::raw("user_id"))
            ->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');

        \Log::info(array($start,$end));
        return $pdf->download('Attendance Report.pdf');

    }


    // 15 days
    // public function generatePDF1(){

    //     $date = Carbon::now()->subDays(15);

    //     $pdf = PDF::loadView('admin.myPDF', [
    //         'attendances' => Attendance::where('created_at', '>=', $date)->get()
    //     ])->setPaper('a4','portrait')->save('myPDF.pdf');

    //     return $pdf->download('Attendance Report-15 Days.pdf');

    // }


    // whole month
    public function generatePDF2(){

        $start_date = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $end_date = Carbon::now()->lastOfMonth()->format('Y-m-d');

        $pdf = PDF::loadView('admin.myPDF', [

            'attendances' => Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
            ->whereBetween('attendance_date', [$start_date, $end_date])
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->groupBy(DB::raw("user_id"))
            ->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');

        return $pdf->download('Attendance Report-Month.pdf');


        //per year
    }

}
