<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    protected function return_error($msg,$http_code)
    {
        response()->json(['error' => $msg], $http_code);
    }

    public function listRoles()
    {
 		$role = Role::all();
        // $role = Role::with('modules')->get();
        return $role;
    }

    public function singleRole($id)
    {	
    	if (is_null($id)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($role=Role::find($id)){
		    	//echo $role;
                return $role;
    		}else{
    			return $this->return_error("Role tidak ditemukan",400);
    		}
    	}
    }

    public function addRole(request $request)
    {	
    	$role = new Role;
    	$role->name = $request->name;
    	$role->save();

    	//return "Role berhasil dibuat";
        return response()->json($role, 201);
    }

    public function updRole(request $request,$id)
    {	
    	if (is_null($id) or is_null($request->name)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($role=Role::find($id)){
    			$role->name = $request->name;
    			$role->save();

    			//return "Role berhasil diperbarui";
                return $role;
    		}else{
    			return $this->return_error("Role tidak ditemukan",400);
    		}
    	}
    }

    public function delRole($id)
    {	
    	if (is_null($id)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($role=Role::find($id)){
    			$role->delete();
    			// echo "Role berhasil dihapus.";
                return response()->json(null, 204);
    		}else{
    			return $this->return_error("Role tidak ditemukan",400);
    		}
    	}	
    }

}
