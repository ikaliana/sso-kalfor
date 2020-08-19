<?php

namespace App\Http\Controllers;

use App\Module;
use App\Application;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function list(request $request) 
    {
        $request->validate([
            'app_id' => 'required|exists:App\Application,id',
        ]);

        //return Module::where('client_id',$request->app_id)->orderBy('name', 'asc')->get();
        return Module::with('roles')->where('client_id',$request->app_id)->orderBy('name', 'asc')->get();
    }

    public function create(request $request)
    {
        $request->validate([
            'app_id' => 'required|exists:App\Application,id',
            'name' => 'required',
            'address' => 'unique:App\Module,address,null,null,client_id,'.$request->app_id,
        ]);

        $module = (new Module)->forceFill([
            'name' => $request->name,
            'address' => $request->address,
            'client_id' => $request->app_id
        ]);

        $module->save();

        return response()->json($module, 201);
    }

    public function delete(request $request, $id) 
    {
        if($module=Module::find($id)) {
            $module->delete();

            return response()->json(null, 204);
        }
        else return $this->return_error('Module dengan ID '.$id.' tidak ditemukan',409);
    }
}
