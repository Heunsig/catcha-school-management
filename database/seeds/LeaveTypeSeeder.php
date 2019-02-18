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
        DB::table('selection_option')->insert([
            [
                'value' => 'Vacation',
                'group' => 'leave_type'
            ],
            [
                'value' => 'Personal Excuses',
                'group' => 'leave_type'
            ],
        ]);
    }
}
