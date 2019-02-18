<?php

use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute_value')->insert([
            [
                'attribute_id' => 1,
                'value' => 'New'
            ],
            [
                'attribute_id' => 1,
                'value' => 'Renewal'
            ],
        ]);
    }
}
