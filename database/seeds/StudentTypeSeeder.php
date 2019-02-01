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
        DB::table('category')->insert([
            [
                'value' => 'F1',
                'group' => 'student_type'
            ],
            [
                'value' => 'Non F1',
                'group' => 'student_type'
            ],
        ]);
    }
}
