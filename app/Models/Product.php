<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getProductsFromMenuId($menu_id)
    {
        return $this->where('belong', $menu_id)
                    ->orderBy('sort', 'asc')
                    ->get();
    }

}
