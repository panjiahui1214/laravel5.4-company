<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Http\Controllers\Home\BaseController;

class ProductController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'home.product';
    

    public function __construct(Product $product)
    {
        $this->product = $product;
        parent::__construct();
    }


    // 产品服务页面
    public function showProduct()
    {
        return $this->showSecondMenuView('pro', $this->view, $this->product);
    }

}