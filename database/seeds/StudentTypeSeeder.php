<?php

use Illuminate\Database\Seeder;

class StudentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('selection_option')->insert([
            [
                'key' => 'F1',
                'value' => '1',
                'group' => 'student_type'
            ],
            [
                'key' => 'Vacation English',
                'value' => '2',
                'group' => 'student_type'
            ],
            [
                'key' => 'Regular',
                'value' => '3',
                'group' => 'student_type'
            ],
        ]);
    }
}
