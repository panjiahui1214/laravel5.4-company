<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoursesUser;
use App\Http\Controllers\Admin\BaseController;

class CourseUserController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.course.list_user';

    protected $menu_name = 'course';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 报名管理 */
    // 页面展示
    public function index($id)
    {
        $coursesUsers = CoursesUser::where('cid', $id)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);

        $view_para = array_add($this->view_para, 'coursesUsers', $coursesUsers);

        return view($this->view, $view_para);
    }
}