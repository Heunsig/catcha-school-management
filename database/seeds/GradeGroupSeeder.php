<?php

use Illuminate\Database\Seeder;

class GradeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grade_group')->insert([
            [
                'name' => 'Attendance',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                // 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Homework',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Participation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                // 'created_by' => 1
            ],
            [
                'name' => 'Test',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                // 'created_by' => 1
            ],
        ]);
    }
}
