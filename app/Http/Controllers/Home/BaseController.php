<?php

namespace App\Http\Controllers\Home;

use Request;
use App\Models\Menu;
use App\Models\Company;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->menu = new Menu();
        $this->company = new Company();

        $this->view_para = [
            'model_menu'  =>  $this->menu,
            'model_company'  =>  $this->company,
        ];
    }

    public function showSecondMenuView($menu_ename, $view, $model=null, $model2=null)
    {
        $path = '/'.Request::path();

        $menu_up = Menu::where('ename', $menu_ename)
                            ->first();

        if ( $menu_up->href == $path ) {
            $menu = Menu::where('sort1', $menu_up->sort1)
                        ->where('sort2', 1)
                        ->first();
        }
        else {
            $menu = Menu::where('href', $path)
                        ->first();
        }
        
        $view_para = array_add($this->view_para, 'menu', $menu);
        $view_para = array_add($view_para, 'model', $model);
        $view_para = array_add($view_para, 'model2', $model2);
        $view_para = array_add($view_para, 'menu_up', $menu_up);

        return view($view, $view_para);
    }

    public function showThirdMenuView($view, $href1, $href2, $model_data, $model=null)
    {
        $menu_href = '/'.$href1.'/'.$href2;
        
        if ( '/user/active' == $menu_href ) {
            $menu_up = Menu::where('ename', 'act')
                            ->first();
            
            $menu = (object)['img' => $menu_up->img, 'name' => '我的活动', 'href' => route('user_active')];
        }
        else if ( '/user/course' == $menu_href ) {
            $menu_up = Menu::where('ename', 'cor')
                            ->first();
            
            $menu = (object)['img' => $menu_up->img, 'name' => '我的课程', 'href' => route('user_course')];
        }
        else if ('/index/course' == $menu_href) {
            $menu = Menu::where('ename', 'cor')
                            ->first();

            $menu_up = (object)['name' => '首页', 'href' => '/index'];
        }
        else {
            $menu = Menu::where('href', $menu_href)
                        ->first();

            $menu_up = Menu::where('sort1', $menu->sort1)
                            ->where('sort2', 0)
                            ->first();
        }

        $view_para = array_add($this->view_para, 'menu', $menu);
        $view_para = array_add($view_para, 'menu_up', $menu_up);
        $view_para = array_add($view_para, 'model_data', $model_data);
        $view_para = array_add($view_para, 'model', $model);

        return view($view, $view_para);
    }

}