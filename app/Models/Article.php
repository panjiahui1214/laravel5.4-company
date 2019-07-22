<?php

namespace App\Models;

class Article extends BaseModel
{
    protected $fillable = [
        'title', 'belong', 'txt', 'text', 'cover', 'keywords'
    ];

    public function getBelongAttribute($value)
    {
        return $this->belongFormat($value);
    }

    public function getTwoArticlesFromMenuId($menu_id)
    {
        return $this->whereRaw('find_in_set('.$menu_id.', belong)')
					->orderBy('created_at', 'desc')
					->take(2)
					->get();
    }

    public function getArticlesFromMenuId($menu_id)
    {
        return $this->getFromMenuId($menu_id);
    }
    
}
