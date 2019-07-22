<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuBaseModel extends Model
{
    public function getMenuFromEname($ename)
    {
        return $this->where('ename', $ename)
                    ->first();
    }

}
