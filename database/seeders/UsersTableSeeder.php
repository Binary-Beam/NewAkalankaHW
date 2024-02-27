<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Sandev Dullewa',
                'name' => 'defualt.png',
                'email' => 'sandev.net@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('sandev@123'),
                'remember_token' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2023-08-28 06:43:11',
                'updated_at' => '2023-08-28 06:43:11',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Pasan Withanage',
                'name' => 'defualt.png',
                'email' => 'pasanwithanage530@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('pasan@123'),
                'remember_token' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2023-08-28 06:43:11',
                'updated_at' => '2023-08-28 06:43:11',
            ),
        ));


    }
}
