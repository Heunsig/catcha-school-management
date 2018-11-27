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
                'method' => 'Cash'
            ],
            [
                'method' => 'Credit Card'
            ],
            [
                'method' => 'Paypal'
            ],
        ]);
    }
}
