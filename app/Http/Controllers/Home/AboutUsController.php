<?php

namespace App\Http\Controllers\Home;

use App\Models\Company;
use App\Http\Controllers\Home\BaseController;

class AboutUsController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.aboutUs';
    

    public function __construct()
    {
        parent::__construct();
    }


    // 关于我们页面
    public function showAboutUs()
    {
    	$menu = $this->menu->where('ename', 'about')
                            ->first();

        $view_para = array_add($this->view_para, 'menu', $menu);
        
        return view($this->view, $view_para);
    }
    
}