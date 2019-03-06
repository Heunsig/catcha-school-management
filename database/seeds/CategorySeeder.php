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
                'name' => 'Beginning Track 1',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Beginning Track 2',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Intermediate Track 1',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Intermediate Track 2',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'High Intermediate Track 1',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'High Intermediate Track 2',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Advanced',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'TOFLE',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Intermediate Conversation',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Advanced Conversation',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'TOEIC',
                'description' => ''
            ],
            [
                'parent_category_id' => 2,
                'name' => 'Business',
                'description' => ''
            ],
        ]);
    }
}
