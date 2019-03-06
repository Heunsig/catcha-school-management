<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
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
                'name' => 'Business Plus TOEIC',
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
