<?php

namespace App\Http\Controllers;

use App\User;
use App\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUser()
    {
 		$users=User::all();
    	echo $users;
    }

    public function singleUser($id)
    {	
    	if (is_null($id)){
    		return "Maaf, input tidak lengkap.";
    	}else{
    		if ($user=User::find($id)){
		    	echo $user;
    		}else{
    			return "Maaf, user tidak ditemukan.";
    		}
    	}	
    }

    public function addUser(request $request)
    {	
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();

    	//get user id
    	$roleUser = new RoleUser;
    	$roleUser->user_id = $user->id;
    	$roleUser->role_id = $request->role_id;
    	$roleUser->save();

    	return "User berhasil dibuat";
    }

    public function updUser(request $request,$id)
    {	
    	if (is_null($id) or is_null($request->name) or is_null($request->email) or is_null($request->password)){
    		echo "Maaf, input tidak lengkap.";
    	}else{
    		if ($user=User::find($id)){
    			$user->name = $request->name;
		    	$user->email = $request->email;
		    	$user->password = Hash::make($request->password);
    			$user->save();

    			echo "User berhasil diperbarui.";
    		}else{
    			echo "Maaf, user tidak ditemukan.";
    		}
    		if ($roleUser=RoleUser::where('user_id',$id)->first()){
    			$roleUser->role_id = $request->role_id;
    			$roleUser->save();

    			echo "User role berhasil diperbarui.";
    		}else{
    			$roleUser = new RoleUser;
    			$roleUser->user_id = $id;
    			$roleUser->role_id = $request->role_id;
    			$roleUser->save();

    			echo "User role berhasil diperbarui.";
    		}
    	}
    }

    public function delUser($id)
    {	
    	if (is_null($id)){
    		return "Maaf, input tidak lengkap.";
    	}else{
    		if ($user=User::find($id)){
    			$user->delete();

    			echo "User berhasil dihapus.";
    		}else{
    			echo "Maaf, user tidak ditemukan.";
    		}
    	}
    	if ($roleUser=RoleUser::where('user_id',$id)->first()){
    			$roleUser->delete();

    			echo "User role berhasil dihapus.";
    		}else{

    			echo "Maaf, user role tidak ditemukan.";
    		}
    }

}
