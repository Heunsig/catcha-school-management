<?php

use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
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
                'value' => 'Male',
                'group' => 'sex'
            ],
            [
                'value' => 'Female',
                'group' => 'sex'
            ],
        ]);
    }
}
