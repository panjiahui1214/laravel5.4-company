<?php

namespace App\Models;

use DB;
use Carbon\Carbon;

class Active extends BaseModel
{
    protected $fillable = [
        'tid', 'name', 'start_time', 'end_time',
        'user_num', 'address', 'text'
    ];
    protected $tb_act_theme = 'actives_themes';
    

    public function getStartTimeAttribute($value)
    {
        if ($value) {
            return $this->timeFormat($value);
        }        
    }

    public function getEndTimeAttribute($value)
    {
        if ($value) {
            return $this->timeFormat($value);
        }
    }


    public function theme()
    {
        return $this->belongsTo(ActivesTheme::class, 'tid');
    }

    public function activesUser()
    {
        return $this->hasMany(ActivesUser::class, 'aid');
    }
    

    public function getFontActives($activeType_ename)
    {
        $query = $this->join(
                            $this->tb_act_theme,
                            $this->getTable().'.tid', '=', $this->tb_act_theme.'.id'
                        )
                        ->select(
                            $this->tb_act_theme.'.id as tid',
                            $this->tb_act_theme.'.name as tname',
                            $this->getTable().'.id',
                            $this->getTable().'.name',
                            'start_time',
                            'end_time'
                        );

        switch ($activeType_ename) {
            case 'act_ready':
                $query = $query->where('start_time', '>', Carbon::now());
                break;
            case 'act_start':
                $query = $query->where(function($query) {
                                    $query->where('start_time', '<=', Carbon::now())
                                            ->orWhere('start_time', null);
                                })
                                ->where(function($query) {
                                    $query->where('end_time', '>', Carbon::now())
                                            ->orWhere('end_time', null);
                                });
                break;
            case 'act_end':
                $query = $query->where('end_time', '<=', Carbon::now());
                break;
        }

        $query = $query->orderBy($this->getTable().'.created_at', 'desc')
                    ->get();

        return $query;
                    
    }

}
