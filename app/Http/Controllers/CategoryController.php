<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function student_status()
    {
        $category = Category::where('group', 'student_status')->get();
        return response()->json($category);
    }
}
