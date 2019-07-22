<?php

namespace App\Http\Controllers\Auth;

use Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Menu;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 重写 Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $menu = New Menu();
        $company = New Company();
        return view('auth.register', [
            'model_menu'  =>  $menu,
            'model_company' =>  $company,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mobile = Request::input('mobile');
        return Validator::make($data, [
            'name' => 'required|string|max:25|unique:'.TABLE_USERS,
            'password' => 'required|string|min:6|max:16|confirmed',
            'mobile' => 'required|numeric|regex:/^1[3-9][0-9]{9}$/',
            'captcha' => 'required|in:'.session('sms.'.$mobile.'.register'),
        ], [], [
            'captcha'   =>  '验证码'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*
         * 生成不重复的id值，对外唯一标识用户
         * add by pjh 20180409
         */
        do {
            $uid = str_random(128);
            $exist_uid = User::where('uuid', $uid)->count();
        } while($exist_uid);

        $time = Carbon::now();
        $mobile = Request::input('mobile');
        session(['sms.'.$mobile.'.register' => '']);

        return User::create([
            'uuid' => $uid,
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
            'last_time' => $time,
        ]);
    }
}
