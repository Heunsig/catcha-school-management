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
                'value' => 'In School',
                'group' => 'student_status'
            ],
            [
                'value' => 'Completed',
                'group' => 'student_status'
            ],
            [
                'value' => 'Terminated',
                'group' => 'student_status'
            ],
        ]);
    }
}
