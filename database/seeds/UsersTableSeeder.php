<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
//            new User(['first_name' => "Saury", "last_name" => "Bravo", 'email' => "saurybravo@gmail.com", "username" => "13-4590", 'password' => Hash::make('secret')]),
//            new User(['first_name' => "Julio", "last_name" => "Cesar", 'email' => "juliocesar@gmail.com", "username" => "13-4590", 'password' => Hash::make('secret')]),
//            new User(['first_name' => "Ulises", "last_name" => "Taveras", 'email' => "ulisestaveras@gmail.com", "username" => "13-4590", 'password' => Hash::make('secret')]),
        ])->each->save();
    }
}
