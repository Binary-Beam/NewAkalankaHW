<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create(['name' => 'John Doe']);
        Customer::create(['name' => 'Jane Smith']);
        Customer::create(['name' => 'Clayton Bigsby']);
    }
}
