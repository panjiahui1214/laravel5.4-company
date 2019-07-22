<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'uuid', 'name', 'password',
        'sex', 'mobile', 'email', 'last_time', 'remark',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $tb_act_user = 'actives_users';
    protected $tb_cor_user = 'courses_users';


    public function actives()
    {
        return $this->belongsToMany(Active::class, $this->tb_act_user, 'uid', 'aid');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, $this->tb_cor_user, 'uid', 'cid');
    }

}
