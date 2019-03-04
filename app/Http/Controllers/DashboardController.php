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

use AppEnv;

class DashboardController extends Controller
{
    public function index()
    {

        return response()->json([
            // 'current_studying_students' => [],
            // 'new_students' => [],
            'current_studying_students' => $this->__get_current_studying_students(),
            'new_students' => $this->__get_new_students(),
            'coming_programs' => $this->__get_coming_programs(),
            'finishing_programs' => $this->__get_finishing_programs(),
            'coming_leaves' => $this->__get_coming_leaves(),
            'finishing_leaves' => $this->__get_finishing_leaves(),
            'leaves_today' => $this->__get_leaves_today()
        ]);
    }

    public function get_new_students() {
        $students = Student::whereIn('type_id', AppEnv::get_student_types())
                            ->where('created_at', '>=', Carbon::parse('-2 weeks')
                            ->format('Y-m-d'))
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json(StudentForDashboardResource::collection($students));
    }

    public function get_coming_programs() {
        $program_dates = ProgramDate::with(['program.student'])
                        ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get()
                        ->whereIn('program.student.type_id', AppEnv::get_student_types());

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
        $program_dates = ProgramDate::with(['program.student'])
                        ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get()
                        ->whereIn('product.student.type_id', AppEnv::get_student_types());

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
        $test = Leave::with('student')
                   ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('start_date', 'asc')
                   ->get()
                   ->whereIn('student.type_id', AppEnv::get_student_types());

        // $count = count($test);
        $leaves = LeaveForDashboardResource::collection($test);

        return response()->json($leaves);
    }

    public function get_finishing_leaves()
    {
        $test = Leave::with('student')
                   ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                   ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                   ->orderBy('created_at', 'desc')
                   ->orderBy('completion_date', 'asc')
                   ->get()
                   ->whereIn('student.type_id', AppEnv::get_student_types());

        // $count = count($test);

        $leaves = LeaveForDashboardResource::collection($test);

        return response()->json($leaves);
    }

    public function get_leaves_today()
    {
        $leaves = Leave::with('student')
                  ->whereNull('deleted_at')
                  ->whereDate('start_date', '<=', Carbon::now()->format('Y-m-d'))
                  ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                  ->orderBy('updated_at', 'desc')
                  ->orderBy('completion_date', 'asc')
                  ->get()
                  ->whereIn('student.type_id', AppEnv::get_student_types());

        // $count = count($leaves);

        $showing_leaves = LeaveForDashboardResource::collection($leaves);

        return response()->json($showing_leaves);
    }

    private function __get_current_studying_students()
    {
        $students = Student::whereIn('type_id', AppEnv::get_student_types())->where('status_id', '1')->get();

        return StudentForDashboardResource::collection($students);
        // return count($students);

    }

    private function __get_new_students()
    {
        $students = Student::whereIn('type_id', AppEnv::get_student_types())
                            ->whereNull('deleted_at')
                            ->where('created_at', '>=', Carbon::parse('-2 weeks')->format('Y-m-d'))
                            ->orderBy('created_at', 'desc')
                            ->get();
        return [
            'items' => StudentForDashboardResource::collection($students->take(5)),
            'count' => count($students),
        ];
    }

    private function __get_coming_programs()
    {
        /*
         * Need to apply a good algorism
         */
        $program_dates = ProgramDate::with(['program.student'])
                        ->where('active', 1)
                        ->whereNull('deleted_at')
                        ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        // ->orderBy('created_at', 'desc')
                        ->get()
                        ->whereIn('program.student.type_id', AppEnv::get_student_types());

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
    }

    private function __get_finishing_programs()
    {
        /*
         * Need to apply a good algorism
         */
        $program_dates = ProgramDate::with('program.student')
                        ->where('active', 1)
                        ->whereNull('deleted_at')
                        ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                        ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                        ->get()
                        ->whereIn('program.student.type_id', AppEnv::get_student_types());

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
    }

    private function __get_coming_leaves()
    {
        $test = Leave::with('student')
                ->whereNull('deleted_at')
                ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                ->whereDate('start_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->orderBy('start_date', 'asc')
                ->get()
                ->whereIn('student.type_id', AppEnv::get_student_types());

        $count = count($test);
        $leaves = LeaveForDashboardResource::collection($test->take(5));

        return [
            'items' => $leaves,
            'count' => $count
        ];
    }

    private function __get_finishing_leaves()
    {
        $test = Leave::with('student')
               ->whereNull('deleted_at')
               ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
               ->whereDate('completion_date', '<=', Carbon::parse('+1 month')->format('Y-m-d'))
               ->orderBy('created_at', 'desc')
               ->orderBy('completion_date', 'asc')
               ->get()
               ->whereIn('student.type_id', AppEnv::get_student_types());

        $count = count($test);

        $leaves = LeaveForDashboardResource::collection($test->take(5));

        return [
            'items' => $leaves,
            'count' => $count
        ];
    }

    private function __get_leaves_today()
    {
        $leaves = Leave::with('student')
                  ->whereNull('deleted_at')
                  ->whereDate('start_date', '<=', Carbon::now()->format('Y-m-d'))
                  ->whereDate('completion_date', '>=', Carbon::now()->format('Y-m-d'))
                  ->orderBy('updated_at', 'desc')
                  ->orderBy('completion_date', 'asc')
                  ->get()
                  ->whereIn('student.type_id', AppEnv::get_student_types());

        $count = count($leaves);

        $showing_leaves = LeaveForDashboardResource::collection($leaves->take(10));

        return [
            'items' => $showing_leaves,
            'count' => $count
        ];
    }
}
