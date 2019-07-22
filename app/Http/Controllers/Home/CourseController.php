<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\Course;
use App\Models\Article;
use App\Models\CoursesUser;
use App\Http\Controllers\Home\BaseController;

class CourseController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.course';
    protected $view_det = 'home.course_detail';
    

    public function __construct(Course $course, Article $article)
    {
        $this->course = $course;
        $this->article = $article;
        parent::__construct();
    }


    // 创享课程页面
    public function showCourse()
    {
        return $this->showSecondMenuView('cor', $this->view, $this->course, $this->article);
    }

    // 课程详情页面
    public function showCourseDetail($href1, $href2, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', '找不到该课程');
        }

        return $this->showThirdMenuView($this->view_det, $href1, $href2, $course);
    }


    // 课程报名页面
    public function courseRegister($id)
    {
        if ( !Auth::check() ) {
            return redirect()->route('login');
        }

        $uid = Auth::user()->id;
        $if_reg = CoursesUser::where('cid', $id)
                                ->where('uid', $uid)
                                ->count();
        if ($if_reg) {
            return redirect()->back()->with('error', '请勿重复报名！');
        }

        $course = Course::findOrFail($id);
        $course_user_num = CoursesUser::where('cid', $id)
                                        ->count();

        if ( $course->user_num && ($course_user_num == $course->user_num) ) {
            return redirect()->back()->with('error', '非常抱歉！报名人数已满！');
        }

        CoursesUser::create([
                'cid'   =>  $id,
                'uid'   =>  $uid
            ]);
        return redirect()->back()->with('success', '恭喜您报名成功！');
    }

}