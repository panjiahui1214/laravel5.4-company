<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesUser extends Model
{
	protected $fillable = [
        'cid', 'uid'     
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'cid');
    }

}
