<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\MenusAd;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct($menu_name = null, $menu_href = null)
    {
        $this->menu = new MenusAd();
        $this->menu_home = new Menu();

        if ($menu_name) {
            $this_menu = MenusAd::where('ename', $menu_name)
                                ->first();
        }
        else if ($menu_href) {
            $this_menu = MenusAd::where('href', $menu_href)
                                ->first();
        }

        $first_menus = $this->menu->getFirstMenus();

        $this->view_para = [
            'this_menu'     =>  $this_menu,
            'model_menu'    =>  $this->menu,
            'first_menus'	=>	$first_menus,
        ];

        $this->image_name = time().rand(100000, 999999);
        $this->image_path = 'uploads/image/'.date('Ymd');
    }


    public function getSomeSecondMenus($menus_sort1)
    {
        return Menu::whereIn('sort1', $menus_sort1)
                    ->where('sort2', '<>', 0)
                    ->orderBy('sort1')
                    ->get();
    }

    public function imageValidator($image)
    {
        $ext = $image->getClientOriginalExtension();
        $ext_rule = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $ext_rule)) {
            return '图片格式只能为jpg/jpeg/png/gif';
        }

        $size = $image->getClientSize();
        $max_size = 2097152; // 字节数
        if ($size > $max_size) {
            return '图片大小不可超过2048kb';
        }
    }

    public function imageUpload($name, $image, $path)
    {
        $ext = $image->getClientOriginalExtension(); 
        $newName = $name.'.'.$ext;
        $image->move($path, $newName);
        $urlPath = $path.'/'.$newName;
        return $urlPath;
    }

    public function imageDelete($path)
    {
        $result = unlink($path);
        return $result;
    }

    public function imageRename($oldUrlPath, $newUrlPath)
    {
        $result = rename($oldUrlPath, $newUrlPath);
        return $result;
    }

}