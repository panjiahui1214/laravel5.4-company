<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Auth\LoginBaseController;

class AdminLoginController extends LoginBaseController
{
    /**
     * 重写 Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * 重写 Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * 重写 Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    /**
     * 重写 Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * 定义 操作认证数据库表名称
     *
     * @return string
     */
    public function usertable()
    {
        return TABLE_ADMINS;
    }

    /**
     * 定义 注销后重定向路径
     *
     * @return string
     */
    public function redirectToLogout()
    {
        return '/admin/login';
    }
}
