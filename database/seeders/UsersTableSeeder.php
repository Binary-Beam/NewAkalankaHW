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
                'name' => 'Zuse Web Team',
                'email' => 'web@zuse.lk',
                'email_verified_at' => NULL,
                'password' => Hash::make('Kalupusa321@'),
                'remember_token' => NULL,
                'created_at' => '2023-08-28 06:43:11',
                'updated_at' => '2023-08-28 06:43:11',
            ),
        ));
        
        
    }
}