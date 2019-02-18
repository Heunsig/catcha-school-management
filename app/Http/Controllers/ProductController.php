<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\AttributeResource;

class ProductController extends Controller
{
    public function test()
    {

        // return response()->json('hello world');
    }

    // public function get_attribute($product_id)
    // {
    //     $product = Product::where('id', $product_id)->first();
    //     return response()->json(new AttributeResource($product->attribute()->with('attribute_value')->first()));
    // }
    
    /*
     * Need to refactor
     */
    public function list()
    {
        // $categories = collect(Category::all())->toArray();
        // $products = collect(Product::all())->toArray();
        $categories = collect(CategoryResource::collection(Category::with('attribute.attribute_value')->get()))->toArray();
        $products = collect(ProductResource::collection(Product::with('attribute.attribute_value')->get()))->toArray();

        // return gettype($categories);
        for ($i = 0 ; $i < count($categories) ; $i++) {

            for ($j = 0 ; $j < count($products) ; $j++) {
                // if ($categories[$i]['id'] === $products[$j]['category_id']) {
                if ($categories[$i]['value'] === $products[$j]['category_id']) {
                    if (!isset($categories[$i]['children'])) {
                        $categories[$i]['children'] = [];
                    }

                    array_push($categories[$i]['children'], $products[$j]);
                }
            }
        }

        return response()->json($this->nested_category($categories));
    }

    // private function nested_products ($queue, $value=null) {
    //     $result = [];
    //     $temp = [];
    //     for ($i = 0 ; $i < count($queue) ; $i++) {
    //         if ($queue[$i]['parent_category_id'] === $value) {
    //             $result[] = $queue[$i];
    //         } else {
    //             $temp[] = $queue[$i];
    //         }
    //     }

    //     for ($j = 0 ; $j < count($result) ; $j++) {
    //         $hey = $this->nested_products($temp, $result[$j]['value']);
    //         if ($hey) {
    //             $result[$j]['children'] = $hey;
    //         }
    //     }

    //     return $result;
    // }
    
    private function nested_category ($queue, $value=null) {
        $result = [];
        $temp = [];
        for ($i = 0 ; $i < count($queue) ; $i++) {
            if ($queue[$i]['parent_category_id'] === $value) {
                $result[] = $queue[$i];
            } else {
                $temp[] = $queue[$i];
            }
        }

        for ($j = 0 ; $j < count($result) ; $j++) {
            // $hey = $this->nested_category($temp, $result[$j]['id']);
            $hey = $this->nested_category($temp, $result[$j]['value']);
            if ($hey) {
                if (!isset($result[$j]['children'])) {
                    $result[$j]['children'] = [];
                }

                $result[$j]['children'] = array_merge($result[$j]['children'], $hey);
            } else {
                if (!isset($result[$j]['children'])) {
                    $result[$j]['disabled'] = true;    
                }
                
            }
        }

        return $result;
    }
}
