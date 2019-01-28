<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
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
                'name' => 'Vacation',
                'group' => 'leave_type'
            ],
            [
                'name' => 'Personal Excuses',
                'group' => 'leave_type'
            ],
        ]);
    }
}
