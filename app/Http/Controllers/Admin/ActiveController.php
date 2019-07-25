<?php

namespace App\Http\Controllers\Admin;

use Request;
use Validator;
use App\Models\Active;
use App\Models\ActivesTheme;
use App\Http\Requests\ActiveRequest;

class ActiveController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.active.list';
    protected $view_addupd = 'admin.active.addupd';

    protected $menu_name = 'active';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 活动管理 */
    // 页面展示
    public function index($tid)
    {
        $actives['actives'] = Active::where('tid', $tid)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
        $actives['theme'] = ActivesTheme::find($tid);

        $view_para = array_add($this->view_para, 'actives', $actives);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView($tid)
    {
        $activesTheme = ActivesTheme::find($tid);

        $view_para = array_add($this->view_para, 'activesTheme', $activesTheme);

        return view($this->view_addupd, $view_para);
    } 
    // 表单处理
    public function addPost($tid, ActiveRequest $request)
    {
        $data = Request::all();
        $data['tid'] = $tid;
        Active::create($data);

        return redirect()->route($this->menu_name, ['tid' => $tid])->with('success', '添加成功');
    }


    /* 修改 */
    // 页面展示
    public function updView($tid, $id)
    {
        $active = Active::find($id);
        if (!$active) {
            return redirect()->route($this->menu_name)->with('error', '找不到该活动');
        }

        $activesTheme = ActivesTheme::find($tid);

        $view_para = array_add($this->view_para, 'active', $active);
        $view_para = array_add($view_para, 'activesTheme', $activesTheme);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($tid, $id, ActiveRequest $request)
    {
        $active = Active::find($id);
        if (!$active) {
            return redirect()->route($this->menu_name)->with('error', '找不到该活动');
        }

        $active = Request::except('_token');
        Active::where('id', $id)
                ->update($active);

        return redirect()->route($this->menu_name, ['tid' => $tid])->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($tid, $id)
    {
        Active::destroy($id);
        
        return redirect()->route($this->menu_name, ['tid' => $tid])->with('success', '删除成功');
    }
}