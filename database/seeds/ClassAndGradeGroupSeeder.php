<?php

use Illuminate\Database\Seeder;

class ClassAndGradeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link_class_grade_group')->insert([
            [
                'classinfo_id' => 2,
                'grade_group_id' => 1
            ],
            [
                'classinfo_id' => 2,
                'grade_group_id' => 2
            ],
            [
                'classinfo_id' => 2,
                'grade_group_id' => 3
            ],
            [
                'classinfo_id' => 2,
                'grade_group_id' => 4  
            ]
        ]);
    }
}
