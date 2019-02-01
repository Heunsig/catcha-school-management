<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
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
