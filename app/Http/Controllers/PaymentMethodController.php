<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function list()
    {
        $payment_methods = PaymentMethod::all();
        return response()->json($payment_methods);
    }
}
