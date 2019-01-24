<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassInProgram;

use Carbon;

use App\Http\Resources\ClassInProgramResource;

class ClassInProgramController extends Controller
{
    // public function edit_date(Request $request, $student_id, $pivot_id)
    // {
    //     $student = Student::where('id', $student_id)->first();
    //     $student->classinfo()->newPivotStatement()
    //                          ->where('id', $pivot_id)
    //                          ->update([
    //                             'start_date' => $request->start_date,
    //                             'completion_date' => $request->completion_date,
    //                             'updated_at' => Carbon::now(),
    //                             'updated_by' => $request->user()->id,
    //                          ]);

    //     $class = $student->classinfo()->wherePivot('id', $pivot_id)->first();

    //     return response()->json(new StudentClassResource($class));
    // }
    public function edit_date(Request $request, $class_in_program_id)
    {
        $class = ClassInProgram::where('id', $class_in_program_id)->first();
        $class->start_date = $request->start_date;
        $class->completion_date = $request->completion_date;
        $class->updated_at = Carbon::now();
        $class->updated_by = $request->user()->id;
        $class->save();

        $edited_class = ClassInProgram::where('id', $class_in_program_id)->first();
        return response()->json(new ClassInProgramResource($edited_class));
    }

    public function complete_class(Request $request, $class_in_program_id)
    {
        $class = ClassInProgram::where('id', $class_in_program_id)->first();
        $class->completion_date = $request->completion_date;
        $class->updated_at = Carbon::now();
        $class->updated_by = $request->user()->id;
        $class->save();

        $updated_class = ClassInProgram::where('id', $class_in_program_id)->first();
        return response()->json(new ClassInProgramResource($updated_class));
    }
}
