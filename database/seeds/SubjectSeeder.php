<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject')->insert([
            [
                'classinfo_id' => 2,
                'name' => 'Speaking',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'classinfo_id' => 2,
                'name' => 'Listening',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'classinfo_id' => 2,
                'name' => 'Grammar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'classinfo_id' => 2,
                'name' => 'Grammar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
