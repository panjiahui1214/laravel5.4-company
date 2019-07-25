<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActivesUser;

class ActiveUserController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.active.list_user';

    protected $menu_name = 'active';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 报名管理 */
    // 页面展示
    public function index($tid, $id)
    {
        $activesUsers = ActivesUser::where('aid', $id)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);

        $view_para = array_add($this->view_para, 'activesUsers', $activesUsers);

        return view($this->view, $view_para);
    }
}