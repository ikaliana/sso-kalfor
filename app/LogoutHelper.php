<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Session;
use Cookie;
use DB;

class LogoutHelper {

	public function Logout(Request $request) 
	{
		if (Auth::check()) {
			
			if ($request->isMethod('get')) return view('logout');

		    //logout on single device
		    //$user = Auth::user()->token();
		    //$user->revoke();

		    DB::table('oauth_access_tokens')
		        ->where('user_id', Auth::user()->id)
		        ->update([ 'revoked' => true ]);

		    \Cookie::queue(\Cookie::forget('laravel_session'));
		    \Session::forget('laravel_session');
		    //\Session::flush();

		}
		else {

			//redirect immediately if Auth::check is false for GET request
			if ($request->isMethod('get')) {
				$backUrl = $request->query('back');
				return redirect($backUrl);
			}

		}
	}
}