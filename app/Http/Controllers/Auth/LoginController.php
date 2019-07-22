<?php

namespace App\Http\Controllers\Auth;

use App\Models\Menu;
use App\Models\Company;
use App\Http\Controllers\Auth\LoginBaseController;

class LoginController extends LoginBaseController
{
    /**
     * 重写 Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * 重写 Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 重写 Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $menu = New Menu();
        $company = New Company();
        return view('auth.login', [
            'model_menu'  =>  $menu,
            'model_company' =>  $company,
        ]);
    }    

    /**
     * 定义 操作认证数据库表名称
     *
     * @return string
     */
    public function usertable()
    {
        return TABLE_USERS;
    }

    /**
     * 定义 注销后重定向路径
     *
     * @return string
     */
    public function redirectToLogout()
    {
        return '/';
    }
}
