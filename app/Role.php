<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function modules()
    {
    	return $this->belongsToMany('App\Module','module_role','role_id','module_id')->as('access_mode')
                    ->withPivot('create', 'read', 'update', 'delete');
    }
}
