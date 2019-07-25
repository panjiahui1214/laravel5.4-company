<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $fillable = [
        'name', 'belong', 'sort', 'image', 'href', 'txt'
    ];


    public function getBelongAttribute($value)
    {
        return $this->belongFormat($value);
    }

    public function getProductsFromMenuId($menu_id)
    {
        return $this->where('belong', $menu_id)
                    ->orderBy('sort')
                    ->get();
    }

}
