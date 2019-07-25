<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Active;
use App\Models\ActivesTheme;
use App\Http\Requests\ActiveThemeRequest;

class ActiveThemeController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.active.list_theme';
    protected $view_addupd = 'admin.active.addupd_theme';

    protected $menu_name = 'active';
    protected $route_href = 'activeTheme';
    

    public function __construct()
    {
        parent::__construct($this->menu_name);
    }

    /* 活动主题管理 */
    // 页面展示
    public function index()
    {
        $activesThemes = ActivesTheme::where([])
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

        $view_para = array_add($this->view_para, 'activesThemes', $activesThemes);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView()
    {
        return view($this->view_addupd, $this->view_para);
    }
    // 表单处理
    public function addPost(ActiveThemeRequest $request)
    {
        ActivesTheme::create([
            'name'  =>  Request::input('name')
        ]);

        return redirect()->route($this->route_href)->with('success', '添加成功');
    }


    /* 修改 */
    // 页面展示
    public function updView($tid)
    {
        $activesTheme = ActivesTheme::find($tid);
        if (!$activesTheme) {
            return redirect()->route($this->route_href)->with('error', '找不到该活动主题');
        }

        $view_para = array_add($this->view_para, 'activesTheme', $activesTheme);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($tid, ActiveThemeRequest $request)
    {
        $activeTheme = ActivesTheme::find($tid);
        if (!$activeTheme) {
            return redirect()->route($this->route_href)->with('error', '找不到该活动主题');
        }

        ActivesTheme::where('id', $tid)
                    ->update([
                        'name' =>  Request::input('name')
                    ]);

        return redirect()->route($this->route_href)->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($tid)
    {
        $if_del = Active::where('tid', $tid)
                        ->count();

        if ($if_del) {
            return redirect()->route($this->route_href)->with('error', '请先删除该主题下的活动');
        }

        ActivesTheme::destroy($tid);
        return redirect()->route($this->route_href)->with('success', '删除成功');
    }
}