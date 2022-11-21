<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Attendance;
use PDF;
use DB;

class PDFController extends Controller {
    

    public function show()
    {
        return view('admin.reports');
    }

    public function generatePDF(){

        $pdf = PDF::loadView('admin.myPDF', [
            'attendances' => Attendance::select("*", DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( total_time ) ) ) AS timeSum"))
            ->groupBy(DB::raw("user_id"))
            ->get()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');

        

        return $pdf->download('Attendance Report.pdf');

    }

}