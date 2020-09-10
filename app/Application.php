<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Passport\Client;

class Application extends Client
{
    protected $hidden = ['provider', 'personal_access_client','user_id','password_client','revoked'];
    protected $appends = ['is_native','is_active'];

    public function getIsNativeAttribute()
    {
        return $this->password_client;
    }

    public function setIsNativeAttribute($value)
    {
        $this->password_client= $value;
    }

    public function getIsActiveAttribute()
    {
        return !$this->revoked;
    }

    public function setIsActiveAttribute($value)
    {
        $this->revoked= !$value;
    }

    public function menus()
    {
        return $this->hasMany('App\Module','client_id');
    }
}
