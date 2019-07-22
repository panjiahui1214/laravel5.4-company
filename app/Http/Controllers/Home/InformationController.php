<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Http\Controllers\Home\BaseController;

class InformationController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.information';
    protected $view_art = 'home.article';
    

    public function __construct(Article $article)
    {
        $this->article = $article;
        parent::__construct();
    }


    // 新闻资讯页面
    public function showInformation()
    {
        return $this->showSecondMenuView('info', $this->view, $this->article);
    }

    // 文章详情页面
    public function showArticle($href1, $href2, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with('error', '找不到该文章');
        }

        return $this->showThirdMenuView($this->view_art, $href1, $href2, $article);
    }

}