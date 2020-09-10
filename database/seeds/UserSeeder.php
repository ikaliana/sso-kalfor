<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [ 'name' => 'Administrator', 'email' => 'admin@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'User KLHK 1', 'email' => 'klhk1@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'User KLHK 2', 'email' => 'klhk2@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'Registrant 1', 'email' => 'registrant1@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'Registrant 2', 'email' => 'registrant2@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'Guest User 1', 'email' => 'guest01@mail.com', 'password' => Hash::make('password') ],
            [ 'name' => 'Guest User 2', 'email' => 'guest02@mail.com', 'password' => Hash::make('password') ],
        ]);
    }
}
