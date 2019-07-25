<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use Validator;
use App\Models\Course;
use App\Http\Requests\CourseRequest;

class CourseController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.course.list';
    protected $view_addupd = 'admin.course.addupd';

    protected $menu_name = 'course';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    // 获取所属菜单选项
    public function getBelongMenus()
    {
        $cor_sort1 = $this->menu_home->where('ename', 'cor')
                                        ->first()
                                        ->sort1;
                                        
        $menus_sort1 = [$cor_sort1];

        return $this->getSomeSecondMenus($menus_sort1);
    }


    /* 课程管理 */
    // 页面展示
    public function index()
    {
        $courses = Course::where([])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'courses', $courses);
        $view_para = array_add($view_para, 'menu_home', $this->menu_home);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView()
    {
        $view_para = array_add($this->view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function addPost(CourseRequest $request)
    {
        $data = Request::except('_token');
        $data['belong'] = implode(',', Request::input('belong'));
        Course::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route($this->menu_name)->with('error', '找不到该课程');
        }
        
        $view_para = array_add($this->view_para, 'course', $course);
        $view_para = array_add($view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($id, CourseRequest $request)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route($this->menu_name)->with('error', '找不到该课程');
        }
        
        $course = Request::except('_token');
        $course['belong'] = implode(',', Request::input('belong'));
        Course::where('id', $id)
                ->update($course);

        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($id)
    {
        Course::destroy($id);
        
        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }
}
