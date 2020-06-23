<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_id = DB::table('users')->where('email', 'admin@mail.com')->value('id');
    	$role_id = DB::table('roles')->where('name', 'Administrator')->value('id');

        DB::table('role_user')->insert([
            'user_id' => $user_id,
            'role_id' => $role_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
