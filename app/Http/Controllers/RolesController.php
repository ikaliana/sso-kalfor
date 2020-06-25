<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function listRoles()
    {
 		$role = Role::all();
    	echo $role;
    }

    public function singleRole($id)
    {	
    	if (is_null($id)){
    		return "Maaf, input tidak lengkap.";
    	}else{
    		if ($role=Role::find($id)){
		    	echo $role;
    		}else{
    			return "Maaf, role tidak ditemukan.";
    		}
    	}
    }

    public function addRole(request $request)
    {	
    	$role = new Role;
    	$role->name = $request->name;
    	$role->save();

    	return "Role berhasil dibuat";
    }

    public function updRole(request $request,$id)
    {	
    	if (is_null($id) or is_null($request->name)){
    		return "Maaf, input tidak lengkap.";
    	}else{
    		if ($role=Role::find($id)){
    			$role->name = $request->name;
    			$role->save();

    			return "Role berhasil diperbarui";
    		}else{
    			return "Maaf, role tidak ditemukan.";
    		}
    	}
    }

    public function delRole($id)
    {	
    	if (is_null($id)){
    		return "Maaf, input tidak lengkap.";
    	}else{
    		if ($role=Role::find($id)){
    			$role->delete();
    			return "Role berhasil dihapus.";
    		}else{
    			return "Maaf, role tidak ditemukan.";
    		}
    	}	
    }

}
