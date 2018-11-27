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
                'price' => 0,
                'quantity' => -1,
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'Conversation program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'TOFLE program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => today(),
                'created_by' => 1
            ],
            [
                'name' => 'TOEIC program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => today(),
                'created_by' => 1
            ]
        ]);
    }
}
