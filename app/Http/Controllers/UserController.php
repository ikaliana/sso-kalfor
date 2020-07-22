<?php

namespace App\Http\Controllers;

use App\User;
use App\RoleUser;
use App\Rules\MatchOldPassword;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class UserController extends Controller
{
    protected function return_error($msg,$http_code)
    {
        response()->json(['error' => $msg], $http_code);
    }

    public function listUser()
    {
 		$users=User::all();
    	//echo $users;
        return $users;
    }

    public function singleUser($id)
    {	
    	if (is_null($id)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($user=User::find($id)){
		    	//echo $user;
                return $user;
    		}else{
    			return $this->return_error("User tidak ditemukan",400);
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

    	//return "User berhasil dibuat";
        $roles = $user->roles;
        return response()->json($user, 201);
    }

    public function updUser(request $request,$id)
    {	
    	if (is_null($id) or is_null($request->name) or is_null($request->email) or is_null($request->password)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($user=User::find($id)){
    			$user->name = $request->name;
		    	$user->email = $request->email;
		    	$user->password = Hash::make($request->password);
    			$user->save();

    			echo "User berhasil diperbarui";
    		}else{
    			return $this->return_error("User tidak ditemukan",400);
    		}
    		if ($roleUser=RoleUser::where('user_id',$id)->first()){
    			$roleUser->role_id = $request->role_id;
    			$roleUser->save();

    			echo "User role berhasil diperbarui";
    		}else{
    			$roleUser = new RoleUser;
    			$roleUser->user_id = $id;
    			$roleUser->role_id = $request->role_id;
    			$roleUser->save();

    			echo "User role berhasil diperbarui";
    		}
    	}
    }

    public function delUser($id)
    {	
    	if (is_null($id)){
    		return $this->return_error("Input tidak lengkap",400);
    	}else{
    		if ($user=User::find($id)){
    			$user->delete();

    			// echo "User berhasil dihapus";
                return response()->json(null, 204);
    		}else{
    			return $this->return_error("User tidak ditemukan",400);
    		}
    	}
    	if ($roleUser=RoleUser::where('user_id',$id)->first()){
    			$roleUser->delete();

    			// echo "User role berhasil dihapus";
                return response()->json(null, 204);
    		}else{

    			return $this->return_error("User role tidak ditemukan",400);
    		}
    }


    //Digunakan untuk WEB/GET method. Fungsi untuk menampilkan change password form.
    public function showChangePasswordForm() {
        return view('auth.passwords.change');
    }

    public function submitChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        //session('status')
        session()->put('status', 'You have successfully change your password!');

        return redirect('/home');
    }

}
