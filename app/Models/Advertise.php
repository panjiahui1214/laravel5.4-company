<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
	protected $fillable = [
        'name', 'tpid', 'sort', 'image', 'href'
    ];

    public function type()
    {
        return $this->belongsTo(AdvertisesType::class, 'tpid');
    }
    
}
