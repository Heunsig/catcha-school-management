<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GradeScore;
use Carbon;

class GradeScoreController extends Controller
{
    public function store(Request $request)
    {
        $formatted_date = Carbon::parse($request->date)->format('Y-m-d');

        $grade_score = GradeScore::where('student_id', $request->student_id)
                            ->where('grade_group_id', $request->grade_group_id)
                            ->where('classinfo_id', $request->classinfo_id)
                            ->where('subject_id', $request->subject_id)
                            ->where('date', $formatted_date)
                            ->first();

        if ($grade_score) {
            $grade_score->student_id = $request->student_id;
            $grade_score->grade_group_id = $request->grade_group_id;
            $grade_score->classinfo_id = $request->classinfo_id;
            $grade_score->subject_id = $request->subject_id;
            $grade_score->score = $request->score;
            $grade_score->date = Carbon::parse($request->date)->format('Y-m-d');
            $grade_score->updated_at = Carbon::now();
            $grade_score->updated_by = $request->user()->id;
            $grade_score->save();
        } else {
            $grade_score = new GradeScore();
            $grade_score->student_id = $request->student_id;
            $grade_score->grade_group_id = $request->grade_group_id;
            $grade_score->classinfo_id = $request->classinfo_id;
            $grade_score->subject_id = $request->subject_id;
            $grade_score->score = $request->score;
            $grade_score->date = Carbon::parse($request->date)->format('Y-m-d');
            $grade_score->updated_at = Carbon::now();
            $grade_score->updated_by = $request->user()->id;
            $grade_score->save();
        }
        
        return response()->json('success');
    }

    public function get_scores($classinfo_id, $subject_id, $date)
    {
        $scores = GradeScore::where('classinfo_id', $classinfo_id)
                            ->where('subject_id', $subject_id)
                            ->whereDate('date', $date)
                            ->get();

        $grouped = $scores->groupBy('student_id'); 


        return response()->json($grouped->toArray());
    }

    public function get_avg_scores_by_student(Request $request, $classinfo_id, $from, $to)
    {
        $scores = GradeScore::where('classinfo_id', $classinfo_id)
                            ->whereDate('date', '>=', $from)
                            ->whereDate('date', '<=', $to)
                            ->get();

        $grouped_by_student = $scores->groupBy(['student_id', 'grade_group_id']);

        foreach($grouped_by_student as $student) {
            foreach($student as $grade => $value) {
                $count = count($value);
                $student[$grade] = collect($value)->sum(function($product) {
                    return $product['score'];
                });

                $student[$grade] = $student[$grade] / $count;
            }
        }

        return response()->json($grouped_by_student);
    }

    public function get_detail_scores_by_student($classinfo_id, $student_id, $from, $to)
    {
        $scores = GradeScore::where('classinfo_id', $classinfo_id)
                            ->where('student_id', $student_id)
                            ->whereDate('date', '>=', $from)
                            ->whereDate('date', '<=', $to)
                            ->get();

        $grouped_by_grade_group = $scores->groupBy(['grade_group_id', function($item){
            return Carbon::parse($item->date)->format('Y-m-d');
        }]);

        return response()->json($grouped_by_grade_group);
    }
}
