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
                'name' => 'In progress',
                'group' => 'student_status'
            ],
            [
                'name' => 'Graduated',
                'group' => 'student_status'
            ],
            [
                'name' => 'Prospective',
                'group' => 'student_status'
            ],
        ]);
    }
}
