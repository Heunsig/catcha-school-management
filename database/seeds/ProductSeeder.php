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
                'name' => 'English Programs',
                'parent_product_id' => null,
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'ESL program',
                'parent_product_id' => 1,
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'Conversation program',
                'parent_product_id' => 1,
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'TOFLE program',
                'parent_product_id' => 1,
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'name' => 'TOEIC program',
                'parent_product_id' => 1,
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
