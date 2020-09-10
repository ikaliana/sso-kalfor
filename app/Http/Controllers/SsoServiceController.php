<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;
use App\LogoutHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SsoServiceController extends Controller
{
    public function Settings()
    {
        return view('settings');
    }

    //Hanya digunakan via API/POST. Fungsi untuk mendapatkan info user yg sedang login
    public function GetUserInfo(Request $request) 
    {
        if (Auth::check()) {
            $user = $request->user();
            $user->makeHidden('email_verified_at','created_at','updated_at');
            $copy_user = clone $user;

            $apps = [];
            $roles = collect();

            foreach ($user->roles as $role) {
                
                $copy_role = clone $role;

                foreach($role->modules as $menu) {
                    $menu->load('application:id,name');

                    $app = $menu->application->only(['id','name']);
                    $app_exists = array_key_exists($app['id'],$apps);
                    
                    if($app_exists) $app = $apps[$app['id']];
                    else {
                        $app['menus'] = collect();
                        $apps[$app['id']] = $app;
                    }

                    $new_menu['id'] = $menu->id;
                    $new_menu['name'] = $menu->name;
                    $new_menu['address'] = $menu->address;
                    $new_menu['access_mode'] = $menu->access_mode->only(['create','read','update','delete']);

                    $app['menus']->add($new_menu);

                }

                //$copy_role['applications'] = $apps;
                $copy_role['applications'] = collect();
                foreach($apps as $app) $copy_role['applications']->add($app);

                $roles->add($copy_role);
            }

            $copy_user['roles'] = $roles;
            return $copy_user;

        }
		else return response()->json(['error' => 'API: Unauthenticated User'], 401);
	}

    public function GetUserInfoOld(Request $request)
    {
        if (Auth::check()) {
            $user = $request->user();
            $roles = $user->roles;
            $user->makeHidden('email_verified_at','created_at','updated_at');

            foreach ($user->roles as $role) {
                foreach($role->modules as $module) {
                    $module->load('application:id,name');
                    $module->makeHidden('client_id');
                }
            }

            return $user;        
        }
    }

    //Hanya digunakan via API/POST (lihat di Route API). Fungsi logout
	public function Logout(Request $request)
	{
        $helper = new LogoutHelper();
        return $helper->Logout($request);
	}
}
