<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Admin\BaseController;

class CompanyController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.company.list';
    protected $view_upd = 'admin.company.upd';

    protected $menu_name = 'company';
    protected $image_path = 'uploads/company/images';

    
    public function __construct()
    {
        parent::__construct($this->menu_name);
    }


    /* 公司信息管理 */
    // 页面展示
    public function index()
    {
        $companys = Company::where([])
                            ->paginate(10);

        $view_para = array_add($this->view_para, 'companys', $companys);

        return view($this->view, $view_para);
    }

    /* 编辑 */
    // 页面展示
    public function updView($id)
    {
        $company = Company::find($id);

        $view_para = array_add($this->view_para, 'company', $company);

        return view($this->view_upd, $view_para);
    }

    // 表单处理
    public function updPost($id, CompanyRequest $request)
    {
        $company = Company::find($id);

        $image = Request::file('image');
        if ($image) {
            $errors_image = $this->imageValidator($image);
            if ($errors_image) {
                return redirect()->back()->with('errors_image', $errors_image)->withInput();
            }
            
            $company->image = $this->imageUpload($company->ename, $image, $this->image_path);
        }
        
        $company->value = Request::input('value');
        $company->save();

        return redirect()->route($this->menu_name)->with('success', '编辑成功');
    }


    /* 删除图片 */
    public function delImg($id)
    {
        $company = Company::find($id);

        $image_name = $company->image;
        if ($image_name) {
            if (file_exists($image_name) && !$this->imageDelete($image_name)) {
                return redirect()->route($this->menu_name)->with('error', '图片删除失败');
            }

            $company->image = null;
            $company->save();
        }

        return redirect()->route($this->menu_name)->with('success', '图片删除成功');
    }

}