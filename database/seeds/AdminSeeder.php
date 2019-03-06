<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('user')->insert([
    		'first_name' => 'Heunsig',
	        'middle_name' => '',
	        'last_name' => 'Jo',
	        'email' => 'heunsig@mliesl.edu',
	        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret,
	        'created_at' => Carbon::now(),
	        'created_by' => 1,
	        'updated_at' => Carbon::now(),
	        'updated_by' => 1
    	]);
    }
}
