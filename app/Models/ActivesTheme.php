<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivesTheme extends Model
{
	protected $fillable = [
        'name'     
    ];


    public function actives()
    {
    	return $this->hasMany(Active::class, 'tid');
    }
    
}
