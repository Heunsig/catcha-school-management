<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classinfo;

class ClassinfoController extends Controller
{
    public function list()
    {
        $classes = Classinfo::all();
        return response()->json($classes);
    }
}
