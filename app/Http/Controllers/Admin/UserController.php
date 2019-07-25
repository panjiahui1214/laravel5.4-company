<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\User;
use App\Models\UsersProfile;
use App\Http\Requests\MobileRequest;
use App\Http\Requests\UserNameRequest;
use App\Http\Requests\EmailAndRemarkRequest;

class UserController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.user.list';
    protected $view_addupd = 'admin.user.addupd';
    protected $view_pro = 'admin.user.pro';

    protected $menu_name = 'user';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 会员管理 */
    // 页面展示
    public function index()
    {
        $users = User::where([])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        $view_para = array_add($this->view_para, 'users', $users);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView()
    {
        return view($this->view_addupd, $this->view_para);
    }
    // 表单处理
    public function addPost(
                                UserNameRequest $request,
                                MobileRequest $request,
                                EmailAndRemarkRequest $request
                            )
    {
        // 生成不重复的id值，对外唯一标识用户
        do {
            $uid = str_random(128);
            $exist_uid = User::where('uuid', $uid)->count();
        } while($exist_uid);

        $data = Request::all();
        $data['uuid'] = $uid;
        $data['password'] = bcrypt('888888');  // 设置会员默认密码：888888
        User::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route($this->menu_name)->with('error', '找不到该会员');
        }

        $view_para = array_add($this->view_para, 'user', $user);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost(
                                $id,
                                MobileRequest $request,
                                EmailAndRemarkRequest $request
                            )
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route($this->menu_name)->with('error', '找不到该会员');
        }
        
        $user->mobile = Request::input('mobile');
        $user->email = Request::input('email');
        $user->remark = Request::input('remark');
        $user->save();

        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 密码重置 */
    public function updPwd($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route($this->menu_name)->with('error', '找不到该会员');
        }

        $user->password = bcrypt('888888');
        $user->save();

        return redirect()->route($this->menu_name)->with('success', '密码重置成功');
    }


    /* 删除 */
    public function del($id)
    {
        User::destroy($id);
        
        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }


    /* 查看资料 */
    public function proView($id)
    {
        $profile = UsersProfile::find($id);
        $userName = User::find($id)->name;

        $view_para = array_add($this->view_para, 'pro', $profile);
        $view_para = array_add($view_para, 'userName', $userName);

        return view($this->view_pro, $view_para);
    }
}