<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Attendance;
use PDF;

class PDFController extends Controller {
    

    public function show()
    {
        return view('admin.reports');
    }

    public function generatePDF(){

        $pdf = PDF::loadView('admin.myPDF', [
            'attendances' => Attendance::all()
        ])->setPaper('a4','portrait')->save('myPDF.pdf');

        

        return $pdf->download('Attendance Report.pdf');

    }

}