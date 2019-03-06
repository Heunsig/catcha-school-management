<?php

use Illuminate\Database\Seeder;

class ProgramTestFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Program::class, 500)->create();
    }
}
