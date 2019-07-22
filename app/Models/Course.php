<?php

namespace App\Models;

class Course extends BaseModel
{
    protected $fillable = [
        'name', 'belong', 'user_name', 'address', 'text',
        'start_date', 'end_date', 'keywords', 'description'   
    ];


    public function getBelongAttribute($value)
    {
        return $this->belongFormat($value);
    }

    public function getCoursesFromMenuId($menu_id)
    {
        return $this->getFromMenuId($menu_id);
    }

    public function coursesUser()
    {
        return $this->hasMany(CoursesUser::class, 'cid');
    }

}
