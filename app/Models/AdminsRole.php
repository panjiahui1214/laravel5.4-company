<?php

namespace App\Models;

class AdminsRole extends BaseModel
{    
    protected $fillable = [
        'name', 'description', 'menus_id'
    ];

    public function getMenusIdAttribute($value)
    {
        return $this->belongFormat($value);
    }

    public function admins()
    {
    	return $this->hasMany(Admin::class, 'rid');
    }
    
}
