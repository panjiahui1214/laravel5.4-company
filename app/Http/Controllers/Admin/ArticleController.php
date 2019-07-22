<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Admin\BaseController;

class ArticleController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.article.list';
    protected $view_addupd = 'admin.article.addupd';

    protected $menu_name = 'article';


    public function __construct()
    {
        parent::__construct($this->menu_name);

        $this->cover_name = time().rand(100000, 999999);
        $this->cover_path = 'uploads/image/'.date('Ymd');
    }


    // 获取所属菜单选项
    public function getBelongMenus()
    {
        $cor_sort1 = $this->menu_home->where('ename', 'cor')
                                        ->first()
                                        ->sort1;

        $info_sort1 = $this->menu_home->where('ename', 'info')
                                        ->first()
                                        ->sort1;
                                        
        $menus_sort1 = [$cor_sort1, $info_sort1];

        return $this->getSomeSecondMenus($menus_sort1);
    }


    /* 文章管理 */
    // 页面展示
    public function index()
    {
        $articles = Article::where([])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'articles', $articles);
        $view_para = array_add($view_para, 'menu_home', $this->menu_home);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView()
    {
        $view_para = array_add($this->view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function addPost(ArticleRequest $request)
    {
        $cover = Request::file('cover');
        if (!$cover) {
            return redirect()->back()->with('errors_image', '封面不可为空')->withInput();
        }
        $errors_cover = $this->imageValidator($cover);
        if ($errors_cover) {
            return redirect()->back()->with('errors_image', $errors_cover)->withInput();
        }
        
        $path = $this->imageUpload($this->cover_name, $cover, $this->cover_path);

        $data = Request::except('cover');
        $data['cover'] = $path;
        $data['belong'] = implode(',', Request::input('belong'));
        Article::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->route($this->menu_name)->with('error', '找不到该文章');
        }

        $view_para = array_add($this->view_para, 'article', $article);
        $view_para = array_add($view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($id, ArticleRequest $request)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->route($this->menu_name)->with('error', '找不到该文章');
        }

        $cover = Request::file('cover');
        if ($cover) {
            $errors_cover = $this->imageValidator($cover);
            if ($errors_cover) {
                return redirect()->back()->with('errors_image', $errors_cover)->withInput();
            }
            
            $path = $this->imageUpload($this->cover_name, $cover, $this->cover_path);
            $article->cover = $path;
        }

        $data = Request::except(['_token', 'path']);
        $data['belong'] = implode(',', Request::input('belong'));
        Article::where('id', $id)
                ->update($data);
        
        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($id)
    {
        Article::destroy($id);
        
        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }

}
