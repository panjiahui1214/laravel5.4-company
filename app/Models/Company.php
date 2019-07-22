<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'company';
	protected $fillable = [
        'name', 'ename', 'value', 'image',
        'width', 'height'
    ];

    public function getCompanyFromEname($ename)
    {
        return $this->where('ename', $ename)
                    ->first();
    }
    
}
