<?php

namespace App\Models;

class Menu extends MenuBaseModel
{
    public $timestamps = false;


    public function getMenuFromIsort($isort)
    {
        return $this->where('isort', $isort)
                    ->first();
    }

    public function getSecondMenusFromEname($ename)
    {
        return $this->where('sort1', $this->getMenuFromEname($ename)->sort1)
                    ->where('sort2', '<>', 0)
                    ->orderBy('sort2', 'asc')
                    ->get();
    }

    public function getFirstMenus()
    {
        return $this->where('sort2', 0)
                    ->orderBy('sort1', 'asc')
                    ->get();
    }

    public function getSameSort1Menus($ename)
    {
        return $this->where('sort1', $this->getMenuFromEname($ename)->sort1)
                    ->orderBy('sort2', 'asc')
                    ->get();
    }

}
