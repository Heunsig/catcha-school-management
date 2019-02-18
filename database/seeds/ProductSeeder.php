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
                'category_id' => 1,
                'name' => 'ESL program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Conversation program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'TOFLE program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'TOEIC program',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 2,
                'name' => 'Common Voca',
                'price' => 60,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 3,
                'name' => 'Black Azar',
                'price' => 55,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ]
        ]);
    }
}
