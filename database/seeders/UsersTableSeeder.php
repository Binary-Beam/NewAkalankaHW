<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'email' => 'sandev.net@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gcCuF5t.NTlJkJJGuQHGUOMz8pxL3hxugEtLsHXpB2u7/LGf9EMC.',
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
                'email' => 'pasanwithanage530@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gcCuF5t.NTlJkJJGuQHGUOMz8pxL3hxugEtLsHXpB2u7/LGf9EMC.',
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
