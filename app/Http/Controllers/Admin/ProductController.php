<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use Validator;
use App\Models\product;
use App\Http\Requests\ProductRequest;

class ProductController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.product.list';
    protected $view_addupd = 'admin.product.addupd';

    protected $menu_name = 'product';


    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    // 获取所属菜单选项
    public function getBelongMenus()
    {
        $pro_sort1 = $this->menu_home->where('ename', 'pro')
                                        ->first()
                                        ->sort1;

        $menus_sort1 = [$pro_sort1];

        return $this->getSomeSecondMenus($menus_sort1);
    }


    /* 产品管理 */
    // 页面展示
    public function index()
    {
        $products = Product::where([])
                            ->orderBy('sort')
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'products', $products);
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
    public function addPost(ProductRequest $request)
    {
        $image = Request::file('image');
        if (!$image) {
            return redirect()->back()->with('errors_image', '图片不可为空')->withInput();
        }
        $errors_image = $this->imageValidator($image);
        if ($errors_image) {
            return redirect()->back()->with('errors_image', $errors_image)->withInput();
        }

        $path = $this->imageUpload($this->image_name, $image, $this->image_path);

        $data = Request::except(['_token', 'image']);
        $data['image'] = $path;
        $data['belong'] = implode(',', Request::input('belong'));
        product::create($data);

        return redirect()->route($this->menu_name)->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $product = product::find($id);
        if (!$product) {
            return redirect()->route($this->menu_name)->with('error', '找不到该课程');
        }

        $view_para = array_add($this->view_para, 'product', $product);
        $view_para = array_add($view_para, 'menus', $this->getBelongMenus());

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function updPost($id, productRequest $request)
    {
        $product = product::find($id);
        if (!$product) {
            return redirect()->route($this->menu_name)->with('error', '找不到该产品');
        }

        $image = Request::file('image');
        if ($image) {
            $errors_image = $this->imageValidator($image);
            if ($errors_image) {
                return redirect()->back()->with('errors_image', $errors_image)->withInput();
            }

            $path = $this->imageUpload($this->image_name, $image, $this->image_path);
            $product->image = $path;
        }

        $product = Request::except(['_token', 'image']);
        $product['belong'] = implode(',', Request::input('belong'));
        product::where('id', $id)
                ->update($product);

        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($id)
    {
        product::destroy($id);
        
        return redirect()->route($this->menu_name)->with('success', '删除成功');
    }
}
