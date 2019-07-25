<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Admin;
use App\Models\AdminsRole;
use App\Http\Requests\RoleRequest;

class RoleController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.role.list';
    protected $view_addupd = 'admin.role.addupd';

    protected $menu_name = 'role';

    
    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    // 获取所属菜单选项
    public function getBelongMenus()
    {
        return $this->menu->where('sort2', '<>', 0)
                            ->where('sort3', '<>', 0)
                            ->whereNotNull('href')
                            ->orderBy('sort1')
                            ->orderBy('sort2')
                            ->orderBy('sort3')
                            ->get();
    }


    /* 角色管理 */
    // 页面展示
    public function index()
    {
        $roles = AdminsRole::where([])
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'roles', $roles);
        $view_para = array_add($view_para, 'menu', $this->menu);

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
    public function addPost(RoleRequest $request)
    {
        $data = Request::except('_token');
        $data['menus_id'] = implode(',', Request::input('menus_id'));
        AdminsRole::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $role = AdminsRole::find($id);
        if (!$role) {
            return redirect()->route($this->menu_name)->with('error', '找不到该角色');
        }
        
        $view_para = array_add($this->view_para, 'role', $role);
        $view_para = array_add($view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($id, RoleRequest $request)
    {
        if (1 == $id) {
            return redirect()->route($this->menu_name)->with('error', '该角色不可编辑');
        }

        $role = AdminsRole::find($id);
        if (!$role) {
            return redirect()->route($this->menu_name)->with('error', '找不到该角色');
        }
        
        $role = Request::except('_token');
        $role['menus_id'] = implode(',', Request::input('menus_id'));
        AdminsRole::where('id', $id)
                    ->update($role);

        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($id)
    {
        $if_del = Admin::where('rid', $id)
                        ->count();

        if ($if_del) {
            return redirect()->route($this->menu_name)->with('error', '请先删除该角色下的管理员');
        }

        AdminsRole::destroy($id);
        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }

}