<?php

use Illuminate\Database\Seeder;

class ModuleRoleSeeder extends Seeder
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

    	$module1 = DB::table('modules')->where('address', '/builder')->value('id');
    	$module2 = DB::table('modules')->where('address', '/report')->value('id');
    	$module3 = DB::table('modules')->where('address', '/collect')->value('id');
    	$module4 = DB::table('modules')->where('address', '/dashboard')->value('id');
    	$module5 = DB::table('modules')->where('address', '/survey')->value('id');

        DB::table('module_role')->insert(
            [ 'module_id' => $module1, 'role_id' => $role_admin_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
            [ 'module_id' => $module2, 'role_id' => $role_admin_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
            [ 'module_id' => $module3, 'role_id' => $role_admin_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
            [ 'module_id' => $module4, 'role_id' => $role_admin_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
            [ 'module_id' => $module5, 'role_id' => $role_admin_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
        );

        DB::table('module_role')->insert(
            [ 'module_id' => $module1, 'role_id' => $role_klhk_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
            [ 'module_id' => $module2, 'role_id' => $role_klhk_id, 'create' => 0, 'read' => 1, 'update' => 0, 'delete' => 0 ],
            [ 'module_id' => $module3, 'role_id' => $role_klhk_id, 'create' => 0, 'read' => 1, 'update' => 0, 'delete' => 0 ],
            [ 'module_id' => $module4, 'role_id' => $role_klhk_id, 'create' => 0, 'read' => 1, 'update' => 0, 'delete' => 0 ],
            [ 'module_id' => $module5, 'role_id' => $role_klhk_id, 'create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1 ],
        );
    }
}
