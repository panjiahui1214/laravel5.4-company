<?php

namespace App\Http\Controllers\Admin;

use DB;

class IndexController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.index';
    
    protected $menu_name = 'index';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }

    
    // 后台首页
    public function showIndex()
    {
        $laravel = app();
        $mysqlVersion = DB::select('select VERSION() as version');
        
        $view_para = array_add($this->view_para, 'laravel', $laravel);
        $view_para = array_add($view_para, 'mysqlVersion', $mysqlVersion);

        return view($this->view, $view_para);
    }
    
}