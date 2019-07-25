<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\AdvertisesType;

class AdvertiseTypeController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.advertise.list_type';

    protected $menu_name = 'advertise';

    
    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 广告位种类管理 */
    // 页面展示
    public function index()
    {
        $advTypes = AdvertisesType::where([])
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'advertiseTypes', $advTypes);

        return view($this->view, $view_para);
    }

}