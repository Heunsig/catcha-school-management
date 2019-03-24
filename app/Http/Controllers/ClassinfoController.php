<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classinfo;
use Carbon;

use App\Http\Resources\ClassResource;
use App\Http\Resources\ClassListResource;

class ClassinfoController extends Controller
{
    public function list()
    {
        $classes = Classinfo::whereNull('deleted_at')->get();
        return response()->json(ClassListResource::collection($classes));
    }

    public function store(Request $request)
    {
        $class = new Classinfo();
        $class->name = $request->name;
        $class->description = $request->description;
        $class->created_at = Carbon::now();
        $class->created_by = $request->user()->id;
        $class->updated_at = Carbon::now();
        $class->updated_by = $request->user()->id;
        $class->save();

        return response()->json($class);
    }

    public function show($classinfo_id)
    {
        $class = Classinfo::where('id', $classinfo_id)->first();

        return response()->json(new ClassResource($class));
    }

}
