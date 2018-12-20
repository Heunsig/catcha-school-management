<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_method')->insert([
            [
                'key' => 'CA',
                'method' => 'Cash'
            ],
            [
                'key' => 'CC',
                'method' => 'Credit Card'
            ],
            [
                'key' => 'PP',
                'method' => 'Paypal'
            ],
        ]);
    }
}
