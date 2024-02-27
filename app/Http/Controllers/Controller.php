<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        // $product = Product::find(8);
        // $category = $product->category;

        // // $customer = Customer::find(1);
        // // $customer->products()->attach([1, 2, 3]);

        // // // Get products bought by a customer
        // // $customerProducts = $customer->products;

        // // dd($customerProducts);

        // $customer = Customer::find(3);

        // if ($customer) {
        //     $products = $customer->products()->get();

        //     foreach ($products as $product) {
        //         echo $product->name . "<br>";
        //     }
        // } else {
        //     echo "Customer not found";
        // }

        return view('welcome');
    }
}
