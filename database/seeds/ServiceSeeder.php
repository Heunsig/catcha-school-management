<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
                'parent_category_id' => null,
                'name' => 'Services',
                'description' => ''
            ],
        ]);

        DB::table('product')->insert([
            [
                'category_id' => 15,
                'name' => 'Processing Fee',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
            [
                'category_id' => 15,
                'name' => 'ID Card',
                'price' => 0,
                'quantity' => -1,
                'created_at' => Carbon::now(),
                'created_by' => 1,
                'updated_at' => Carbon::now(),
                'updated_by' => 1
            ],
        ]);
    }
}
