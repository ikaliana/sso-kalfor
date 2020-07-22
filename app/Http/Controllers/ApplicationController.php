<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Application;

class ApplicationController extends Controller
{
    protected function return_error($msg,$http_code)
    {
    	response()->json(['error' => $msg], $http_code);
    }

    protected function validate_mandatory(request $request) 
    {
    	if(is_null($request->name)) return $this->return_error('Nama aplikasi wajib diisi',400); 
    	if(is_null($request->redirect)) return $this->return_error('Redirect URL wajib diisi',400);
    }

    public function list() {
    	return Application::whereNotIn('id', [1,2])->get();
    }

    public function get($id) 
    {
    	$app = Application::find($id);

        if(is_null($app)) return $this->return_error('Applikasi tidak ditemukan',404);

    	return $app;
    }

    public function create(request $request)
    {	
    	$this->validate_mandatory($request);

    	$secret = Str::random(40);
    	$is_native = false;
    	if(!is_null($request->is_native)) $is_native = filter_var($request->is_native, FILTER_VALIDATE_BOOLEAN);

    	$app = (new Application)->forceFill([
            'user_id' => null,
            'name' => $request->name,
            'secret' => Str::random(40),
            'provider' => 'users',
            'redirect' => $request->redirect,
            'personal_access_client' => false,
            'password_client' => $is_native,
            'revoked' => false,
        ]);

        $app->save();

        return response()->json($app, 201);
    }

    public function update(request $request, $id) 
    {
    	$this->validate_mandatory($request);

    	if($app=Application::find($id)) {
	    	$is_native = $app->is_native;
	    	if(!is_null($request->is_native)) $is_native = filter_var($request->is_native, FILTER_VALIDATE_BOOLEAN);

	    	$app->forceFill([
	            'name' => $request->name,
	            'redirect' => $request->redirect,
	            'password_client' => $is_native,
	        ])->save();

	        return $app;
	        //return response()->json($app, 200);
    	}
    	else return $this->return_error('Aplikasi dengan ID '.$id.' tidak ditemukan',409);
    }

    public function delete(request $request, $id) 
    {
    	if($app=Application::find($id)) {
	    	$app->delete();

	        return response()->json(null, 204);
    	}
    	else return $this->return_error('Aplikasi dengan ID '.$id.' tidak ditemukan',409);
    }
}
