<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cookie;
use App\LogoutHelper;
use Illuminate\Support\Facades\DB;

class SsoServiceController extends Controller
{
    public function Settings()
    {
        return view('settings');
    }

    //Called only using API
    public function GetUserInfo(Request $request) 
    {
        if (Auth::check()) {
            $user = $request->user();
            $roles = $user->roles;

            return $user;
        }
		else return response()->json(['data' => 'API: Unauthenticated User'], 401);
	}

	public function Logout(Request $request)
	{
        $helper = new LogoutHelper();
        return $helper->Logout($request);
	}
}
