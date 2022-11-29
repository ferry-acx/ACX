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

        $start = $request->startDate;
        $end = $request->endDate;

        $pdf = PDF::loadView('admin.myPDF', [

            'attendances' => Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
            ->whereBetween('attendance_date', [$start, $end])
            ->groupBy(DB::raw("user_id"))
            ->get()
        ,'dates'=> array($start,$end)
        ])->setPaper('a4','portrait')->save('myPDF.pdf');

        \Log::info(array($start,$end));
        return $pdf->download('Attendance Report.pdf');

    }
}