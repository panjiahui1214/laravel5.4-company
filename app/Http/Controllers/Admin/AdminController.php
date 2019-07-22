<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Admin;
use App\Models\AdminsRole;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\AdminNameRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Controllers\Admin\BaseController;

class AdminController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.admin.list';
    protected $view_addupd = 'admin.admin.addupd';

    protected $menu_name = 'admin';

    
    public function __construct(AdminsRole $adminsRole)
    {
        parent::__construct($this->menu_name);
        $this->adminsRole = $adminsRole;
    }


    public function getRoles()
    {
        return AdminsRole::all();
    }

    public function findAdmin($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $code = 1;
            $mes = $admin;
        }
        else {
            $code = 0;
            $mes = redirect()->route($this->menu_name)->with('error', '找不到该管理员');
        }

        return ['code' => $code, 'mes' => $mes];
    }


    /* 管理员管理 */
    // 页面展示
    public function index()
    {
        $admins = Admin::where([])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        $view_para = array_add($this->view_para, 'admins', $admins);
        $view_para = array_add($view_para, 'adminsRole', $this->adminsRole);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView()
    {
        $roles = $this->getRoles();
        $view_para = array_add($this->view_para, 'roles', $roles);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function addPost(AdminNameRequest $request, PasswordRequest $request)
    {
        $data = Request::all();
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 修改密码 */
    // 页面展示
    public function updPwdView($id)
    {
        $find_admin = $this->findAdmin($id);
        if ( $find_admin['code'] ) {
            $admin = $find_admin['mes'];
        }
        else {
            return $find_admin['mes'];
        }

        $view_para = array_add($this->view_para, 'admin', $admin);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPwdPost($id, PasswordRequest $request)
    {
        if (1 == $id) {
            return redirect()->route($this->menu_name)->with('error', '该管理员不可修改密码');
        }

        $find_admin = $this->findAdmin($id);
        if ( $find_admin['code'] ) {
            $admin = $find_admin['mes'];
        }
        else {
            return $find_admin['mes'];
        }

        $admin->password = bcrypt(Request::input('password'));
        $admin->save();

        return redirect()->route($this->menu_name)->with('success', '修改密码成功');
    }


    /* 修改角色 */
    // 页面展示
    public function updRoleView($id)
    {
        $find_admin = $this->findAdmin($id);
        if ( $find_admin['code'] ) {
            $admin = $find_admin['mes'];
        }
        else {
            return $find_admin['mes'];
        }

        $roles = $this->getRoles();
        $view_para = array_add($this->view_para, 'roles', $roles);
        $view_para = array_add($view_para, 'admin', $admin);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updRolePost($id)
    {
        if (1 == $id) {
            return redirect()->route($this->menu_name)->with('error', '该管理员不可修改角色');
        }

        $find_admin = $this->findAdmin($id);
        if ( $find_admin['code'] ) {
            $admin = $find_admin['mes'];
        }
        else {
            return $find_admin['mes'];
        }

        $admin->rid = Request::input('rid');
        $admin->save();

        return redirect()->route($this->menu_name)->with('success', '修改角色成功');
    }


    /* 删除 */
    public function del($id)
    {
        if (1 == $id) {
            return redirect()->route($this->menu_name)->with('error', '该管理员不可删除');
        }

        Admin::destroy($id);

        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }
}