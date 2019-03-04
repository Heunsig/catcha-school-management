<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon;
use App\Student;

class DocumentController extends Controller
{
    public function pdf_test(Request $request)
    {   
        $sex = ($request->sex === 'Male') ? 'Mr':'Ms';
        $issuing_date = Carbon::parse($request->issuing_date)->format('F d, Y');
        $date_of_birth = Carbon::parse($request->date_of_birth)->format('m/d/Y');

        $start_date = Carbon::parse($request->start_date)->format('m/d/Y');
        $completion_date = Carbon::parse($request->completion_date)->format('m/d/Y');

        $name = $this->name_generator($request->first_name, $request->middle_name, $request->last_name);

        $pdf = PDF::loadView('document.busletter', [
          'name' => $name,
          'sex' => $sex,
          'date_of_birth' => $date_of_birth,
          'country_of_citizenship' => $request->country_of_citizenship,
          'start_date' => $start_date,
          'completion_date' => $completion_date,
          'issuing_date' => $issuing_date
        ]);
        return response($pdf->inline(), 200)->withHeaders([
            'Content-Type' => 'application/pdf'
        ]);
    }

    public function name_generator($first_name, $middle_name, $last_name) {
      $name = '';
      
      if (!is_null($last_name)) {
        $name .= $last_name . ', ';
      }

      if ($first_name) {
        $name .= $first_name;
      }

      if ($middle_name) {
        $name .= ' ' . $middle_name;
      }

      return $name;
    }
}
