<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use App\Student;
use App\User;
use App\Category;
use App\Classinfo;
use App\Payment;
use App\Product;
use App\PaymentMethod;

use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentBasicInformationResource;
use App\Http\Resources\StudentClassResource;
use App\Http\Resources\ProgramTakenResource;

use App\Http\Resources\ClassListResource;
use App\Http\Resources\ClassBelongingToStudentResource;

use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramListResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\InvoiceResource;


class StudentController extends Controller
{   
    public function list()
    {
        $students = Student::all();

        return response()->json(StudentResource::collection($students));
        // $a = $students::where('id', 51)->first(
        // return response()->json($students->category);
    }

    public function register()
    {
        $student_status_options= Category::where('group', 'student_status')->get();
        
        return response()->json([
            'student_status_options' => $student_status_options
        ]);
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
            $student->status_id = $request->status_id;
            $student->save();   

            DB::commit();

            return response()->json([
                'msg' => 'success',
                'student_id' => $user->id
            ]);

        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }

    }

    public function basic_information($student_id)
    {
        $basic_information = Student::with('user')->where('id', $student_id)->first();
        return response()->json(new StudentBasicInformationResource($basic_information));
    }

    public function class($student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $class_selection_options = Classinfo::all();
        $program_selection_options = Product::where('parent_product_id', 1)->get();
        // $programs = $student->program


        // $class_belonging_to = $student->classinfo()->first();
        // $student = Student::where('id', $student_id)->first();
        // $classes = Classinfo::all();

        // $student_class_resource = StudentClassResource::collection($student->classinfo()->get());
        // // $grouped_class = collect($student_class_resource)->sortBy('created_at')->groupBy('program_id');
        // // $result = [];

        // // foreach($grouped_class as $key => $value) {
        // //     $result[] = $value;
        // // }

        // $programs_taken = $student->programs_taken();

        return response()->json([
            'programs' => ProgramResource::collection($student->program),
            'class_selection_options' => ClassListResource::collection($class_selection_options),
            'program_selection_options' => ProgramListResource::collection($program_selection_options),
            // 'classes_belonging_to' => ClassBelongingToStudentResource::collection($classes_belonging_to),
            // 'programs_taken' => ProgramTakenResource::collection(collect($programs_taken))
        ]);
    }

    public function payment($student_id)
    {
        $payment_methods = PaymentMethod::all();
        $payments = Payment::all();

        return response()->json([
            'payments' => InvoiceResource::collection($payments),
            'payment_methods' => PaymentMethodResource::collection($payment_methods)
        ]);
    }

    // public function add_program(Request $request, $student_id)
    // {
    //     $student = Student::where('id', $student_id)->first();
    //     $student->

    // }

    // public function add_class(Request $request, $student_id)
    // {
    //     // $student
    //     // $student = Student::where('id', $student_id)->first();
    //     // $student->classinfo()->attach($request->classinfo_id,
    //     //     [
    //     //         'start_date' => $request->start_date,
    //     //         'program_id' => $request->program_id,
    //     //         'created_by' => $request->user()->id,
    //     //         'updated_by' => $request->user()->id,
    //     //     ]
    //     // );

    //     // $new_class = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first();
    //     // return response()->json(new StudentClassResource($new_class));
    //     // $class = $student->classinfo()->wherePivot('id', $a)->first();

    //     // $student = Student::where('id', $student_id)->first();
    //     // $max_group = $student->classinfo()->max('group');
    //     // $student->classinfo()->attach($request->classinfo_id,
    //     //     [
    //     //         'start_date' => $request->start_date,
    //     //         'group' => $max_group ? $max_group + 1 : 1,
    //     //         'created_by' => $request->user()->id,
    //     //         'updated_by' => $request->user()->id,
    //     //     ]
    //     // );

    //     // $a = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first()->pivot->id;
    //     // $class = $student->classinfo()->wherePivot('id', $a)->first();

    //     // return response()->json(new StudentClassResource($class));
    // }

    // public function change_class(Request $request, $student_id, $pivot_id)
    // {

    //     DB::beginTransaction();

    //     try {
    //         $student = Student::where('id', $student_id)->first();

    //         // Complete the previous class
    //         $student->classinfo()->newPivotStatement()
    //                              ->where('id', $pivot_id)
    //                              ->update([
    //                                 'completion_date' => Carbon::now()->format('Y-m-d'),
    //                                 'updated_at' => Carbon::now(),
    //                                 'updated_by' => $request->user()->id,
    //                              ]);

    //         // Open new class
    //         $student->classinfo()->attach($request->form['classinfo_id'], [
    //             'start_date' => $request->form['start_date'],
    //             'group' => $request->group,
    //             'created_by' => $request->user()->id,
    //             'updated_by' => $request->user()->id,
    //         ]);

    //         DB::commit();
    //     } catch(\Illuminate\Database\QueryException $e) {
    //         DB::rollBack();

    //         return response($e);
    //     }

    //     $original_class = $student->classinfo()->wherePivot('id', $pivot_id)->first();
    //     $new_class = $student->classinfo()->withPivot('id')->orderBy('pivot_created_at', 'desc')->first();

    //     return response()->json([
    //         'original_class' => new StudentClassResource($original_class),
    //         'new_class' => new StudentClassResource($new_class)
    //     ]);
    // }

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

    // public function delete_class(Request $request, $student_id, $pivot_id)
    // {
    //     $student = Student::where('id', $student_id)->first();
    //     $student->classinfo()->newPivotStatement()
    //                          ->where('id', $pivot_id)
    //                          ->update([
    //                             'deleted_at' => Carbon::now(),
    //                             'deleted_by' => $request->user()->id
    //                          ]);

    //     $class = $student->classinfo()->wherePivot('id', $pivot_id)->first(); 

    //     return response()->json(new StudentClassResource($class));
    // }
}
