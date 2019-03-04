<?php

namespace App\Helpers;
use App\Setting;

class AppEnv {

    public static function get_student_types()
    {
        $setting = Setting::where('key','Student Type')->first();
        $types = explode(',', $setting->value);
        $result = [];

        foreach($types as $type) {
            $result[] = trim($type);
        }

        return $result;
    }

}