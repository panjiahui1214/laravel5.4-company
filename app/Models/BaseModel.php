<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function timeFormat($time)
    {
        $time = date_create($time);
        return date_format($time,'Y-m-d').'T'.date_format($time,'H:i:s');
    }

	public function belongFormat($belong)
    {
        return explode(',', $belong);
    }

    public function getFromMenuId($menu_id)
    {
        return DB::table($this->getTable())
                    ->whereRaw('find_in_set('.$menu_id.', belong)')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
    
}
