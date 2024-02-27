<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $customers = Customer::all();
        $products = Product::all();

        foreach ($customers as $customer) {
            // Randomly select a number of products to assign to each customer
            $numProducts = rand(1, $products->count());

            // Shuffle the products and select a random subset
            $randomProducts = $products->shuffle()->take($numProducts);

            // Attach the selected products to the current customer
            $customer->products()->attach($randomProducts->pluck('id')->toArray());
        }
    }
}
