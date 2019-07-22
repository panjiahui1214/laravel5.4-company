<?php

namespace App\Http\Controllers\Home;

use App\Models\Course;
use App\Models\Article;
use App\Models\AdvertisesType;
use App\Http\Controllers\Home\BaseController;

class IndexController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.index';
    

    public function __construct(Article $article)
    {
        $this->article = $article;
        parent::__construct();
    }
    

    // 首页
    public function showIndex()
    {
        $banners = AdvertisesType::find(
                        AdvertisesType::where('ename', 'banner')
                                        ->first()
                                        ->id
                    )->advertises;

        $courses = Course::where([])
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();
        
        $view_para = array_add($this->view_para, 'banners', $banners);
        $view_para = array_add($view_para, 'courses', $courses);
        $view_para = array_add($view_para, 'model_article', $this->article);

        return view($this->view, $view_para);
    }

}