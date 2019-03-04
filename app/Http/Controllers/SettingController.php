<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use AppEnv;

class SettingController extends Controller
{
    public function index()
    {   
        return response()->json(AppEnv::get_student_types());
    }

    public function update(Request $request)
    {
        $setting = Setting::where('key', 'Student Type')->first();
        $result = '';
        $a = $request->selected;

        foreach($a as $index => $value) {
            if ($index !== (count($a) - 1)) {
                $result .= $value.','; 
            } else {
                $result .= $value;
            }
        }

        $setting->value = $result;
        $setting->save();

        return response()->json('success');
    }

}
