<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelectionOptionSeeder extends Seeder
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
                'key' => 'In School',
                'value' => '1',
                'group' => 'student_status'
            ],
            [
                'key' => 'Completed',
                'value' => '2',
                'group' => 'student_status'
            ],
            [
                'key' => 'Terminated',
                'value' => '3',
                'group' => 'student_status'
            ],
            [
                'key' => 'Prospective',
                'value' => '4',
                'group' => 'student_status'
            ],
        ]);
    }
}
