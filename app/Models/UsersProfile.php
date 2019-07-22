<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
	public $incrementing = false;

	protected $fillable = [
        'id', 'sex', 'birthday', 'residence', 'education',
        'school', 'class'
    ];

}
