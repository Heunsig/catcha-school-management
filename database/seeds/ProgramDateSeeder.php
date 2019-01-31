<?php

use Illuminate\Database\Seeder;

class ProgramDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProgramDate::class, 5000)->create();
    }
}
