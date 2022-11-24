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
}
