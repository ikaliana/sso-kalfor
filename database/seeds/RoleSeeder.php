<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Administrator'],
            ['name' => 'KLHK'],
            ['name' => 'Registrant'],
            ['name' => 'Guest'],
        ]);
    }
}
