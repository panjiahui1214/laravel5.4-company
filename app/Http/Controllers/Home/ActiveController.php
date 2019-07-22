<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\User;
use App\Models\Active;
use App\Models\ActivesUser;
use App\Http\Controllers\Home\BaseController;

class ActiveController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.active';
    protected $view_det = 'home.active_detail';


    public function __construct(Active $active, ActivesUser $activesUser)
    {
        $this->active = $active;
        $this->activesUser = $activesUser;
        parent::__construct();
    }


    // 活动报名列表页面
    public function showActive()
    {
        return $this->showSecondMenuView('act', $this->view, $this->active, $this->activesUser);
    }


    public function showActiveThirdMenu($view, $href1, $href2, $id)
    {
        $active = Active::findOrFail($id);
        return $this->showThirdMenuView($view, $href1, $href2, $active, $this->activesUser);
    }

    // 活动详情页面
    public function showActiveDetail($href1, $href2, $id)
    {
        return $this->showActiveThirdMenu($this->view_det, $href1, $href2, $id);
    }


    // 活动报名页面
    public function activeRegister($id)
    {
        if ( !Auth::check() ) {
            return redirect()->route('login');
        }

        $uid = Auth::user()->id;
        $if_reg = ActivesUser::where('aid', $id)
                                ->where('uid', $uid)
                                ->count();
        if ($if_reg) {
            return redirect()->back()->with('error', '请勿重复报名！');
        }

        $active = Active::find($id);
        if (!$active) {
            return redirect()->back()->with('error', '找不到该活动');
        }
        
        $active_user_num = ActivesUser::where('aid', $id)
                                        ->count();

        if ( $active->user_num && ($active_user_num == $active->user_num) ) {
            return redirect()->back()->with('error', '非常抱歉！报名人数已满！');
        }

        ActivesUser::create([
                'aid'   =>  $id,
                'uid'   =>  $uid
            ]);
        return redirect()->back()->with('success', '恭喜您报名成功！');
    }

}