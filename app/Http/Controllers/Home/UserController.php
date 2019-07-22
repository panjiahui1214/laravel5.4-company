<?php

namespace App\Http\Controllers\Home;

use Hash;
use Auth;
use Config;
use Request;
use Validator;
use App\Models\User;
use App\Models\Active;
use App\Models\Course;
use App\Libs\Aliyun\Sms;
use App\Models\ActivesUser;
use App\Models\UsersProfile;
use App\Http\Requests\MobileRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Controllers\Home\BaseController;

class UserController extends BaseController
{
	/* 视图文件相对路径 */
    protected $view = 'home.user.index';
    protected $view_act = 'home.user.active';
    protected $view_actSco = 'home.user.active_score';
    protected $view_cor = 'home.user.course';
    protected $view_pro = 'home.user.profile';
    protected $view_pwd = 'home.user.password';
    protected $view_secur = 'home.user.security';
    protected $view_mobile = 'home.user.mobile';
    protected $view_email = 'home.user.email';
    protected $view_forget = 'auth.forget';

    protected $education = [
        '初中以下', '初中', '中专', '高中', '大专',
        '本科', '研究生', '硕士', '博士', '博士后'
    ];

    public function __construct(ActivesUser $activesUser)
    {
        $this->activesUser = $activesUser;
        parent::__construct();
    }


    public function getUser()
    {
        $user = User::find(Auth::user()->id);
        $user->mobile = $this->encryptMobile($user->mobile);

        return $user;
    }


    // 会员中心首页
    public function index()
    {
        $view_para = array_add($this->view_para, 'user', $this->getUser());

        return view($this->view, $view_para);
    }


    // 参与活动
    public function act()
    {
        $actives = User::find(Auth::user()->id)->actives;
  
        $view_para = array_add($this->view_para, 'actives', $actives);
        $view_para = array_add($view_para, 'model_activesUser', $this->activesUser);

        return view($this->view_act, $view_para);
    }


    // 参加课程
    public function cor()
    {
        $courses = User::find(Auth::user()->id)->courses;
  
        $view_para = array_add($this->view_para, 'courses', $courses);

        return view($this->view_cor, $view_para);
    }


    /* 更改资料 */
    // 页面展示
    public function proView()
    {
        $profile = UsersProfile::where('id', Auth::user()->id)->first();

        $view_para = array_add($this->view_para, 'pro', $profile);
        $view_para = array_add($view_para, 'education', $this->education);

        return view($this->view_pro, $view_para);
    }
    // 表单处理
    public function proPost(UserProfileRequest $request)
    {
        UsersProfile::updateOrCreate(
            ['id' => Auth::user()->id], Request::except('_token')
        );

        return redirect()->route('user_profile')->with('success', '更改资料成功');
    }


    /* 安全中心首页 */
    public function securityView()
    {
        $view_para = array_add($this->view_para, 'user', $this->getUser());

        return view($this->view_secur, $view_para);
    }


    /* 修改密码 */
    // 页面展示
    public function pwdView()
    {
        return view($this->view_pwd, $this->view_para);
    }
    // 表单处理
    public function pwdPost(PasswordRequest $request)
    {
        $user = User::find(Auth::user()->id);

        if ( !Hash::check(Request::input('old_password'), $user->password) ) {
            return redirect()->back()
                    ->withErrors(['old_password' => '原密码错误'])
                    ->withInput();
        }

        $user->password = bcrypt(Request::input('password'));
        $user->save();

        return redirect()->route('user_secur')->with('success', '修改密码成功');
    }


    /* 修改手机 */
    // 页面展示
    public function mobileView()
    {
        $view_para = array_add($this->view_para, 'user', $this->getUser());

        return view($this->view_mobile, $view_para);
    }
    // 表单处理
    public function mobilePost(MobileRequest $request)
    {
        $validator = Validator::make(
            Request::all(), [
                'captcha' => 'required|in:'.session('sms.'.Request::input('mobile').'.mobile')
            ], [], [
                'captcha'   =>  '验证码'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        User::where('id', Auth::user()->id)
            ->update(['mobile', Request::input('mobile')]);

        return redirect()->route('user_secur')->with('success', '修改手机成功');
    }


    /* 修改邮箱 */
    // 页面展示
    public function emailView()
    {
        $view_para = array_add($this->view_para, 'user', $this->getUser());

        return view($this->view_email, $view_para);
    }
    // 表单处理
    public function emailPost()
    {
        $validator = Validator::make(
            Request::all(), [
                'email'     =>  'email'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        User::where('id', Auth::user()->id)
            ->update(['email' => Request::input('email')]);

        return redirect()->route('user_secur')->with('success', '修改邮箱成功');
    }


    /* 忘记密码 */
    // 页面展示
    public function forgetView()
    {
        return view($this->view_forget, $this->view_para);
    }
    // 表单处理
    public function forgetPost(PasswordRequest $request)
    {
        $name = Request::input('name');
        $user = User::where('name', $name)->first();
        
        $validator = Validator::make(
            Request::all(), [
                'captcha' => 'required|in:'.session('sms.'.$user->mobile.'.password')
            ], [], [
                'captcha'   =>  '验证码'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user->password = bcrypt(Request::input('password'));
        $user->save();
        return redirect()->route('login');
    }



    // 给手机号码加密
    public function encryptMobile($mobile)
    {
        $encryptMb = substr_replace($mobile, '****', 3, 4);
        return $encryptMb;
    }


    // 根据手机号码或会员账号发送短信
    public function sendSmsByMobileOrName()
    {
        $mobile = Request::input('mobile');
        $name = Request::input('name');
        $templete = Request::input('templete');
        
        if (!$mobile && !$name) {
            return response()
                    ->json(['error' => '请输入手机号码或会员账号']);
        }
        if ($mobile) {
            if (!preg_match('/^1[3-9][0-9]{9}$/', $mobile)) {
                return response()
                        ->json(['error' => '请输入正确的新手机号码']);
            }
        }
        if ($name) {
            $user = User::where('name', $name)->first();
            if (!$user) {
                return response()
                        ->json(['error' => '会员账号不存在']);
            }
            $mobile = $user->mobile;
        }
        
        $sms = new Sms();
        $smsCode = rand(100000, 999999);
        $templeteCode = Config::get('sms.templeteCode.'.$templete);
        $response = $sms->sendSms($mobile, $templeteCode, $smsCode);
        if ('OK' == $response->Code) {
            session(['sms.'.$mobile.'.'.$templete => $smsCode]);
            return response()
                        ->json(['result' => 'success']);
        }
        else {
            return response()
                        ->json(['result' => '短信'.$response->Message]);
        }
    }

    // 根据会员账号返回手机号码
    public function getMobileFromName()
    {
        $name = Request::input('name');
        $user = User::where('name', $name)->firstOrFail();
        $user->mobile = $this->encryptMobile($user->mobile);
        return $user->mobile;
    }

}