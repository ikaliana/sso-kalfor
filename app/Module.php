<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $hidden = [
        'created_at', 'updated_at','pivot.role_id'
    ];
    
    public function application()
    {
    	return $this->belongsTo('App\Application','client_id');
    }

    public function roles()
    {
    	return $this->belongsToMany('App\Role','module_role','role_id','module_id')
                    ->withPivot('create', 'read', 'update', 'delete');
    }
}
