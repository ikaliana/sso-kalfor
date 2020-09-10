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
        $role_admin_id = DB::table('roles')->where('name', 'Administrator')->value('id');
        $role_klhk_id = DB::table('roles')->where('name', 'KLHK')->value('id');
        $role_registrant_id = DB::table('roles')->where('name', 'Registrant')->value('id');
        $role_guest_id = DB::table('roles')->where('name', 'Guest')->value('id');

    	$admin = DB::table('users')->where('email', 'admin@mail.com')->value('id');
        $klhk1 = DB::table('users')->where('email', 'klhk1@mail.com')->value('id');
        $klhk2 = DB::table('users')->where('email', 'klhk2@mail.com')->value('id');
        $reg1 = DB::table('users')->where('email', 'registrant1@mail.com')->value('id');
        $reg2 = DB::table('users')->where('email', 'registrant2@mail.com')->value('id');
        $guest1 = DB::table('users')->where('email', 'guest01@mail.com')->value('id');
        $guest2 = DB::table('users')->where('email', 'guest02@mail.com')->value('id');

        DB::table('role_user')->insert([
            [ 'user_id' => $admin, 'role_id' => $role_admin_id ],
            [ 'user_id' => $klhk1, 'role_id' => $role_klhk_id ],
            [ 'user_id' => $klhk2, 'role_id' => $role_klhk_id ],
            [ 'user_id' => $reg1, 'role_id' => $role_registrant_id ],
            [ 'user_id' => $reg2, 'role_id' => $role_registrant_id ],
            [ 'user_id' => $guest1, 'role_id' => $role_guest_id ],
            [ 'user_id' => $guest2, 'role_id' => $role_guest_id ],
        ]);
    }
}
