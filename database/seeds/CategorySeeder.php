<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'English Programs',
                'description' => ''
            ],
            [
                'parent_category_id' => null,
                'name' => 'Textbooks',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Beginner',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Intermediate',
                'description' => ''
            ]
        ]);
    }
}
