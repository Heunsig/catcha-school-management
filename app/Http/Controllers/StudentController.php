<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use App\Student;
use App\User;
use App\Http\Resources\StudentBasicInformationResource;
use App\Http\Resources\StudentClassResource;


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
            $user->created_by = $request->user()->id;
            $user->updated_by = $request->user()->id;
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
        return response()->json(new StudentBasicInformationResource($basic_information));
    }

    public function class($student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $student_class_resource = StudentClassResource::collection($student->classinfo()->get());
        $grouped_class = collect($student_class_resource)->sortBy('created_at')->groupBy('group');
        $result = [];

        foreach($grouped_class as $key => $value) {
            $result[] = $value;
        }

        return response()->json($result);
    }

    public function add_class(Request $request, $student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $max_group = $student->classinfo()->max('group');
        $student->classinfo()->attach($request->classinfo_id,
            [
                'start_date' => $request->start_date,
                'group' => $max_group ? $max_group + 1 : 1,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
            ]
        );

        $a = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first()->pivot->id;
        $class = $student->classinfo()->wherePivot('id', $a)->first();

        return response()->json(new StudentClassResource($class));
    }

    public function change_class(Request $request, $student_id)
    {

        DB::beginTransaction();

        try {
            $student = Student::where('id', $student_id)->first();

            $class = $student->classinfo()->newPivotStatement()
                                            ->where('id', $request->selected_student_class_id)
                                            ->update([
                'completion_date' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now(),
                'updated_by' => $request->user()->id,
            ]);

            $student->classinfo()->attach($request->classinfo_id, [
                'start_date' => $request->start_date,
                'group' => $request->selected_student_class_group,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
            ]);

            DB::commit();
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }

        $a = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first()->pivot->id;
        $original_class = $student->classinfo()->wherePivot('id', $request->selected_student_class_id)->first();
        $new_class = $student->classinfo()->wherePivot('id', $a)->first();


        return response()->json([
            'original_class' => new StudentClassResource($original_class),
            'new_class' => new StudentClassResource($new_class)
        ]);
    }

    public function edit_date(Request $request, $student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $class = $student->classinfo()->newPivotStatement()
                                        ->where('id', $request->student_class_id)
                                        ->update([
                'start_date' => $request->start_date,
                'completion_date' => $request->completion_date,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->user()->id,
            ]);

        // $a = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first()->pivot->id;
        $class = $student->classinfo()->wherePivot('id', $request->student_class_id)->first();

        return response()->json(new StudentClassResource($class));
    }

    public function delete_class(Request $request, $student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $class = $student->classinfo()->newPivotStatement()
                                      ->where('id', $request->student_class_id)
                                      ->update([
                                        'deleted_at' => Carbon::now(),
                                        'deleted_by' => $request->user()->id
                                      ]);

        $class = $student->classinfo()->wherePivot('id', $request->student_class_id)->first();                                    

        return response()->json(new StudentClassResource($class));
    }
}
