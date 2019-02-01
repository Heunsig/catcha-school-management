<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramDate;
use App\Leave;
use App\Student;
use App\User;

use Carbon;

use App\Http\Resources\StudentForDashboardResource;
use App\Http\Resources\ProgramDateForDashboardResource;
use App\Http\Resources\LeaveForDashboardResource;

class DashboardController extends Controller
{
    public function index()
    {

        return response()->json([
            'current_studying_students' => $this->__get_current_studying_students(),
            'new_students' => $this->__get_new_students(),
            'coming_programs' => $this->__get_coming_programs(),
            'finishing_programs' => $this->__get_finishing_programs(),
            'coming_leaves' => $this->__get_coming_leaves(),
            'finishing_leaves' =>$this->__get_finishing_leaves()
        ]);
    }

    public function get_new_students() {
        $students = User::with('student')->join('student', 'user.id', '=', 'student.id')
                         ->where('user.created_at', '>=', Carbon::parse('-2 weeks')->format('Y-m-d'))
                         ->orderBy('user.created_at', 'desc')
                         ->get();

        return response()->json(StudentForDashboardResource::collection($students));
    }

    public function get_coming_programs() {
        $program_dates = ProgramDate::with(['program.student.user'])
                        ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get();

        // return $program_dates;

        $grouped_program_dates = $program_dates->filter(function($value){
            return $value->program->deleted_at === null;
        })->groupBy('program.id');

        $result = [];
        foreach($grouped_program_dates as $dates){
            $result[] = $dates[count($dates) - 1];
        }

        $test = collect(collect($result)->sortByDesc('program.created_at')->sortBy('start_date')->values()->all());

        $test = ProgramDateForDashboardResource::collection($test);

        return response()->json($test);
    }

    public function get_finishing_programs() {
        $program_dates = ProgramDate::with(['program.student.user'])
                        ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get();

        // return $program_dates;

        $grouped_program_dates = $program_dates->filter(function($value){
            return $value->program->deleted_at === null;
        })->groupBy('program.id');

        $result = [];
        foreach($grouped_program_dates as $dates){
            $result[] = $dates[count($dates) - 1];
        }

        $test = collect(collect($result)->sortByDesc('program.created_at')->sortBy('completion_date')->values()->all());

        $test = ProgramDateForDashboardResource::collection($test);

        return response()->json($test);
    }

    public function get_coming_leaves()
    {
        $test = Leave::with('student.user')
                   ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('start_date', 'asc')
                   ->get();

        $count = count($test);
        $leaves = LeaveForDashboardResource::collection($test);

        return response()->json($leaves);
    }

    public function get_finishing_leaves()
    {
        $test = Leave::with('student.user')
                   ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('completion_date', 'asc')
                   ->get();

        $count = count($test);

        $leaves = LeaveForDashboardResource::collection($test);

        return response()->json($leaves);
    }

    private function __get_current_studying_students()
    {
        $students = Student::where('status_id', 1)->get();

        return count($students);
    }

    private function __get_new_students()
    {
        $students = User::with('student')->join('student', 'user.id', '=', 'student.id')
                         ->where('user.created_at', '>=', Carbon::parse('-2 weeks')->format('Y-m-d'))
                         ->orderBy('user.created_at', 'desc')
                         ->get();
        return [
            'items' => StudentForDashboardResource::collection($students->take(5)),
            'count' => count($students),
        ];

        // return $students;

        // $students = Student::with('user')
        // //                     ->orderBy('id', 'desc')
        // //                     // ->whereDate('user.created_at', '>=', Carbon::parse('-1 weeks')->format('Y-m-d'))
        //                     // ->take(5)
        //                     ->get();

        // $test = User::whereDate('created_at', '>=', Carbon::parse('-1 weeks')->format('Y-m-d'));
        
        // $result = $students->sortByDesc('user.created_at');


        // return collect($result->values()->all())->take(5);
                            // ->whereDate('user.created_at', '>=', Carbon::parse('+1 weeks')->format('Y-m-d'))

    }

    private function __get_coming_programs()
    {
        /*
         * Need to apply a good algorism
         */
        $program_dates = ProgramDate::with(['program.student.user'])
                        ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get();

        // return $program_dates;

        $grouped_program_dates = $program_dates->filter(function($value){
            return $value->program->deleted_at === null;
        })->groupBy('program.id');

        $result = [];
        foreach($grouped_program_dates as $dates){
            $result[] = $dates[count($dates) - 1];
        }

        $test = collect(collect($result)->sortByDesc('program.created_at')->sortBy('start_date')->values()->all())->take(5);

        $test = ProgramDateForDashboardResource::collection($test);

        return [
            'items' => $test,
            'count' => count($result)
        ];
        // $program_dates = ProgramDateForDashboardResource::collection(
        //     ProgramDate::with(['program.student.user'])
        //                 ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
        //                 ->whereDate('start_date', '<=', Carbon::parse('+2 weeks')->format('Y-m-d'))
        //                 ->get()
        // );

        // $grouped_program_dates = collect($program_dates)->filter(function($value){
        //     return $value['program']['is_deleted'] === false;
        // })->groupBy('program.id');

        // $result = [];
        // foreach($grouped_program_dates as $dates){
        //     $result[] = $dates[count($dates) - 1];
        // }

        // $test = collect($result)->take(10)->sortBy('start_date');
        // // $test = collect($result)->sortBy('start_date');

        // return $test->values()->all();
    }

    private function __get_finishing_programs()
    {
        /*
         * Need to apply a good algorism
         */
        $program_dates = ProgramDate::with('program.student.user')
                        ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        ->get();

        $grouped_program_dates = $program_dates->filter(function($value){
            return $value->program->deleted_at === null;
        })->groupBy('program.id');

        $result = [];
        foreach($grouped_program_dates as $dates){
            $result[] = $dates[count($dates) - 1];
        }

        $test = collect(collect($result)->sortByDesc('program.created_at')->sortBy('completion_date')->values()->all())->take(5);

        $test = ProgramDateForDashboardResource::collection($test);

        return [
            'items' => $test,
            'count' => count($result)
        ];

        // $program_dates = ProgramDateForDashboardResource::collection(
        //     ProgramDate::with('program.student.user')
        //                 ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
        //                 ->whereDate('completion_date', '<=', Carbon::parse('+2 weeks')->format('Y-m-d'))
        //                 ->get()
        // );

        // $grouped_program_dates = collect($program_dates)->filter(function($value){
        //     return $value['program']['is_deleted'] === false;
        // })->groupBy('program.id');

        // $result = [];
        // foreach($grouped_program_dates as $dates){
        //     $result[] = $dates[count($dates) - 1];
        // }

        // $test = collect($result)->take(10)->sortBy('completion_date');
        // // $test = collect($result)->sortBy('completion_date');

        // return $test->values()->all();
    }

    private function __get_coming_leaves()
    {
        $test = Leave::with('student.user')
                   ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('start_date', 'asc')
                   ->get();

        $count = count($test);
        $leaves = LeaveForDashboardResource::collection($test->take(5));

        return [
            'items' => $leaves,
            'count' => $count
        ];
    }

    private function __get_finishing_leaves()
    {
        $test = Leave::with('student.user')
                   ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('completion_date', 'asc')
                   ->get();

        $count = count($test);

        $leaves = LeaveForDashboardResource::collection($test->take(5));

        return [
            'items' => $leaves,
            'count' => $count
        ];
    }
}
