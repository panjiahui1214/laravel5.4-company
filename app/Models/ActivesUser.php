<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivesUser extends Model
{
	protected $fillable = [
        'aid', 'uid'     
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function active()
    {
        return $this->belongsTo(Active::class, 'aid');
    }


    public function auid($aid, $uid)
    {
        return $this->where('aid', $aid)
                    ->where('uid', $uid)
                    ->first()
                    ->id;
    }

}
