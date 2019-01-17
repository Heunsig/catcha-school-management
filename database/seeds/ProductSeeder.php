<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [
                'name' => 'ESL program',
                'category' => 'program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'Conversation program',
                'category' => 'program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'TOFLE program',
                'category' => 'program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'TOEIC program',
                'category' => 'program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ]
        ]);
    }
}
