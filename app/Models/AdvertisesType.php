<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisesType extends Model
{
	public $timestamps = false;

    public function advertises()
    {
    	return $this->hasMany(Advertise::class, 'tpid');
    }
    
}
