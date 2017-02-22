<?php

use Illuminate\Database\Seeder;
// use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'username' => "mdag",
            'firstname' => "Nikki",
            'middle_initial' => "A",
            'sex' => "Female",
            'lastname' => "Gallego",
            'contact_number' => "09993647047",
            'user_type' => "ADMIN",
            'email' => "mdag_03@yahoo.com",
            'address' => 'LA',
            'birthdate'=> '',
            'password' => bcrypt('secret'),
            'address' => "liloan",
            'birthdate' => "1994-09-26"
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
