<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Program;
use App\ProgramDate;
use App\ClassInProgram;
use Carbon;

use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramDateResource;
use App\Http\Resources\ClassInProgramResource;

class ProgramController extends Controller
{
    public function list()
    {
        $programs = Program::whereNull('deleted_at')->get();

        return response()->json(ProgramResource::collection($programs));
    }

    public function store(Request $request)
    {
        $program = new Program();
        $program->student_id = $request->student_id;
        $program->product_id = $request->product_id;
        $program->created_at = Carbon::now();
        $program->created_by = $request->user()->id;
        $program->save();

        $program->program_date()->create([
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'reason' => ($request->reason) ? $request->reason : null
        ]);

        $stored_program = Program::where('id', $program->id)->first();

        return response()->json(new ProgramResource($stored_program));
    }

    public function destroy(Request $request, $program_id)
    {
        $program = Program::where('id', $program_id)->first();
        $program->deleted_at = Carbon::now();
        $program->deleted_by = $request->user()->id;
        $program->save();

        $removed_program = Program::where('id', $program_id)->first();

        return response()->json(new ProgramResource($removed_program));
    }

    public function add_class(Request $request)
    {
        $class = new ClassInProgram();
        $class->classinfo_id = $request->classinfo_id;
        $class->student_id = $request->student_id;
        $class->program_id = $request->program_id;
        $class->start_date = $request->start_date;
        $class->created_at = Carbon::now();
        $class->created_by = $request->user()->id;

        $class->save();

        $stored_class = ClassInProgram::where('id', $class->id)->first();

        return response()->json(new ClassInProgramResource($stored_class));
    }

    public function change_class(Request $request, $class_in_program_id)
    {
        DB::beginTransaction();

        try {
            // Complete the current class
            $class = ClassInProgram::where('id', $class_in_program_id)->first();
            $class->completion_date = Carbon::now()->format('Y-m-d');
            $class->updated_at = Carbon::now();
            $class->updated_by = $request->user()->id;
            $class->save();

            // Open the a new class
            $new_class = new ClassInProgram();
            $new_class->classinfo_id = $request->classinfo_id;
            $new_class->student_id = $request->student_id;
            $new_class->program_id = $request->program_id;
            $new_class->start_date = $request->start_date;
            $new_class->created_at = Carbon::now();
            $new_class->created_by = $request->user()->id;
            $new_class->save();

            DB::commit();

        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }

        $original_class = ClassInProgram::where('id', $class->id)->first();
        $new_class = ClassInProgram::where('id', $new_class->id)->first();

        return response()->json([
            'original_class' => new ClassInProgramResource($original_class),
            'new_class' => new ClassInProgramResource($new_class)
        ]);
    }

    public function destroy_class(Request $request, $class_in_program_id)
    {
        $class = ClassInProgram::where('id', $class_in_program_id)->first();
        $class->deleted_at = Carbon::now();
        $class->deleted_by = $request->user()->id;
        $class->save();

        $destroyed_class = ClassInProgram::where('id', $class_in_program_id)->first();
 
        return response()->json(new ClassInProgramResource($destroyed_class));
    }

    public function update_program_date(Request $request, $program_id)
    {
        DB::beginTransaction();

        try {

            $program = Program::where('id', $program_id)->first();

            $program_date = new ProgramDate([
                'start_date' => $request->start_date,
                'completion_date' => $request->completion_date,
                'reason' => $request->reason
            ]);

            $program->program_date()->save($program_date);

            // Updated program
            $program->updated_at = Carbon::now();
            $program->updated_by = $request->user()->id;
            $program->save();

            DB::commit();

        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return response($e);
        }
        

        $updated_program = Program::where('id', $program_id)->first();
        return response()->json(new ProgramResource($updated_program));
    }
}
