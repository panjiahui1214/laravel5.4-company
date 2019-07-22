<?php

namespace App\Models;

class MenusAd extends MenuBaseModel
{
	protected $table = 'menus_ad';

    public $timestamps = false;


    public function getSecondMenusFromSort1($sort1)
    {
    	return $this->where('sort1', $sort1)
    				->where('sort3', 0)
                    ->where('sort2', '<>', 0)
                    ->orderBy('sort2')
                    ->get();
    }

    public function getThirdMenusFromSort1($sort1, $sort2)
    {
    	return $this->where('sort1', $sort1)
    				->where('sort2', $sort2)
                    ->where('sort3', '<>', 0)
                    ->whereNotNull('href')
                    ->orderBy('sort3')
                    ->get();
    }

    public function getFirstMenus()
    {
        return $this->where('sort2', 0)
                    ->where('sort3', 0)
                    ->where('sort1', '<>', 0)
                    ->whereNotNull('href')
                    ->orderBy('sort1', 'asc')
                    ->get();
    }

}
