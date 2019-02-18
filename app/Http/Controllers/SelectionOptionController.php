<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SelectionOption;

class SelectionOptionController extends Controller
{
    public function student_status()
    {
        $student_status_options = SelectionOption::where('group', 'student_status')->get();
        return response()->json($student_status_options);
    }

    public function country() 
    {
        $countries = SelectionOption::where('group', 'country')->get();
        return response()->json($countries);
    }
}
