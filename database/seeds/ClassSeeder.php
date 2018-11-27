<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classinfo')->insert([
            [
                'name' => 'Beginning Track 1',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'Beginning Track 2',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'Intermediate Track 1',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'Intermediate Track 2',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'High Intermediate Track 1',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'High Intermediate Track 2',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'Advanced',
                'description' => '',
                'created_at' => today(),
                'created_by' => 1
            ],
        ]);
    }
}
