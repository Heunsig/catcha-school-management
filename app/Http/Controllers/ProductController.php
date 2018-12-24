<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /*
     * Need to refactor
     */
    public function list()
    {
        $products = Product::get();
        $formatted_prodcuts = collect(ProductResource::collection($products))->toArray();
        $test = $this->nested_products($formatted_prodcuts);

        return response()->json($test);
    }

    private function nested_products ($queue, $value=null) {
        $result = [];
        $temp = [];
        for ($i = 0 ; $i < count($queue) ; $i++) {
            if ($queue[$i]['parent_product_id'] === $value) {
                $result[] = $queue[$i];
            } else {
                $temp[] = $queue[$i];
            }
        }

        for ($j = 0 ; $j < count($result) ; $j++) {
            $hey = $this->nested_products($temp, $result[$j]['value']);
            if ($hey) {
                $result[$j]['children'] = $hey;
            }
        }

        return $result;
    }
}
