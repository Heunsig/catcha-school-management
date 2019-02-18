<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Leave;

use App\Http\Resources\LeaveRequestResource;

class LeaveController extends Controller
{
    public function list()
    {
        
    }

    public function store(Request $request)
    {
        $leave = new Leave();
        $leave->leave_type_id = $request->leave_type_id;
        $leave->student_id = $request->student_id;
        $leave->start_date = $request->start_date;
        $leave->completion_date = $request->completion_date;
        $leave->created_at = Carbon::now();
        $leave->created_by = $request->user()->id;
        $leave->updated_at = Carbon::now();
        $leave->updated_by = $request->user()->id;
        $leave->save();

        $stored_leave = Leave::where('id', $leave->id)->first();
        return response()->json(new LeaveRequestResource($stored_leave));
    }

    public function update(Request $request, $leave_id)
    {
        $leave = Leave::where('id', $leave_id)->first();
        $leave->leave_type_id = $request->leave_type_id;
        // $leave->student_id = $request->student_id;
        $leave->start_date = $request->start_date;
        $leave->completion_date = $request->completion_date;
        $leave->updated_at = Carbon::now();
        $leave->updated_by = $request->user()->id;
        $leave->save();

        $updated_leave = Leave::where('id', $leave->id)->first();
        return response()->json(new LeaveRequestResource($updated_leave));
    }

    public function destroy(Request $request, $leave_id)
    {
        $leave = Leave::where('id', $leave_id)->first();
        $leave->deleted_at = Carbon::now();
        $leave->deleted_by = $request->user()->id;
        $leave->save();

        $deleted_leave = Leave::where('id', $leave_id)->first();
        return response()->json(new LeaveRequestResource($deleted_leave));

    }

    public function attach_program(Request $request, $leave_id)
    {
        $leave = Leave::where('id', $leave_id)->first();
        $leave->updated_at = Carbon::now();
        $leave->updated_by = $request->user()->id;
        $leave->save();

        $leave->program()->syncWithoutDetaching($request->program_ids);

        $updated_leave = Leave::where('id', $leave_id)->with('program')->first();
        return response()->json($updated_leave);
    }

    public function detach_program(Request $request, $leave_id)
    {
        $leave = Leave::where('id', $leave_id)->first();
        $leave->updated_at = Carbon::now();
        $leave->updated_by = $request->user()->id;
        $leave->save();

        $leave->program()->detach($request->program_ids);

        $updated_leave = Leave::where('id', $leave_id)->with('program')->first();
        return response()->json($updated_leave);
    }
}
