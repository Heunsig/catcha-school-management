<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\User;


class StudentController extends Controller
{   
    public function list()
    {
        $student = Student::with('user')->get();

        return response()->json($student);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->nickname = $request->nickname;
            $user->note = $request->note;
            $user->created_by = $request->created_By;
            $user->save();

            $student = new Student();
            $student->id = $user->id;
            $student->status = $request->status;
            $student->save();   

            DB::commit();
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }


        return response()->json('success');
    }

    public function basic_information($student_id)
    {
        $basic_information = Student::with('user')->where('id', $student_id)->first();
        return response()->json($basic_information);
    }

    public function class()
    {
        // $classes = 
    }
}
