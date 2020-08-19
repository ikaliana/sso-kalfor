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

            //$roles = $user->roles;
            //foreach ($user->roles as $role) $role->load('modules');
            //$user->load('roles.modules.application');

            foreach ($user->roles as $role) {
                foreach($role->modules as $module) {
                    $module->load('application:id,name');
                    $module->makeHidden('client_id');
                }
                // $role->load('modules');
            }

            return $user;
        }
		else return response()->json(['error' => 'API: Unauthenticated User'], 401);
	}

    //Hanya digunakan via API/POST (lihat di Route API). Fungsi logout
	public function Logout(Request $request)
	{
        $helper = new LogoutHelper();
        return $helper->Logout($request);
	}
}
