<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Advertise;
use App\Models\AdvertisesType;
use App\Http\Requests\AdvertiseRequest;

class AdvertiseController extends BaseController
{
    /* 视图文件相对路径 */
    protected $view = 'admin.advertise.list';
    protected $view_addupd = 'admin.advertise.addupd';

    protected $menu_name = 'advertise';
    protected $route_href = 'adv';
    protected $image_path = 'uploads/advertise/images';

    
    public function __construct()
    {
        parent::__construct($this->menu_name);
    }

    // 获取图片文件名
    public function getImageName($tpid, $sort)
    {
        return AdvertisesType::find($tpid)->ename.'_'.$sort;
    }

    // 获取图片新排序文件名
    public function getImageNewName($urlPath, $name)
    {
        $path = dirname($urlPath);
        $ext = pathinfo($urlPath, PATHINFO_EXTENSION);
        return $path.'/'.$name.'.'.$ext;
    }


    /* 广告位管理 */
    // 页面展示
    public function index($tpid)
    {
        $advs = Advertise::where('tpid', $tpid)
                                ->orderBy('sort')
                                ->paginate(10);

        $view_para = array_add($this->view_para, 'advertises', $advs);

        return view($this->view, $view_para);
    }


    /* 添加 */
    // 页面展示
    public function addView($tpid)
    {
        $advType = AdvertisesType::find($tpid);
        $view_para = array_add($this->view_para, 'advertiseType', $advType);

        return view($this->view_addupd, $view_para);
    }
    // 表单处理
    public function addPost($tpid, AdvertiseRequest $request)
    {
        $image = Request::file('image');
        if (!$image) {
            return redirect()->back()->with('errors_image', '图片不可为空')->withInput();
        }
        $errors_image = $this->imageValidator($image);
        if ($errors_image) {
            return redirect()->back()->with('errors_image', $errors_image)->withInput();
        }
        
        $data = Request::except('image');
        $ext = $image->getClientOriginalExtension();
        $image_name = $this->getImageName($tpid, $data['sort']);
        $path = $this->imageUpload($image_name, $image, $this->image_path);

        $data['image'] = $path;
        $data['tpid'] = $tpid;
        Advertise::create($data);

        return redirect()->route($this->route_href, ['tpid' => $tpid])->with('success', '添加成功');
    }


    /* 编辑 */
    // 页面展示
    public function updView($tpid, $id)
    {
        $adv = Advertise::find($id);
        $advType = AdvertisesType::find($tpid);
        $view_para = array_add($this->view_para, 'advertise', $adv);
        $view_para = array_add($view_para, 'advertiseType', $advType);

        return view($this->view_addupd, $view_para);
    }

    // 表单处理
    public function updPost($tpid, $id, AdvertiseRequest $request)
    {
        $adv = Advertise::find($id);
        $oldUrlPath = $adv->image;
        $sort = Request::input('sort');
        $image_name = $this->getImageName($adv->tpid, $sort);
        
        $image = Request::file('image');
        if ($image) {
            $adv->image = $this->imageUpload($image_name, $image, $this->image_path); 
        }
        else if (file_exists($oldUrlPath) && $adv->sort!=$sort) {
            $newUrlPath = $this->getImageNewName($oldUrlPath, $image_name);
            $result = $this->imageRename($oldUrlPath, $newUrlPath);
            if (!$result) {
                return redirect()->route($this->route_href, ['tpid' => $tpid])->with('error', '编辑失败');
            }
            $adv->image = $newUrlPath;
        }
        
        $adv->sort = Request::input('sort');
        $adv->href = Request::input('href');
        $adv->save();
        return redirect()->route($this->route_href, ['tpid' => $tpid])->with('success', '编辑成功');
    }


    /* 删除 */
    public function del($tpid, $id)
    {
        $adv = Advertise::find($id);

        $image_name = $adv->image;
        /*if (!$image_name) {
            return redirect()->route($this->route_href, ['tpid' => $tpid])->with('success', '删除成功');
        }
        else if (file_exists($image_name)) {
            $result = $this->imageDelete($image_name);
            if (!$result) {
                return redirect()->route($this->route_href, ['tpid' => $tpid])->with('error', '删除失败');
            }
        }

        $adv->delete();
        return redirect()->route($this->route_href, ['tpid' => $tpid])->with('success', '删除成功');*/

        if ($image_name) {
            if (file_exists($image_name) && !$this->imageDelete($image_name)) {
                return redirect()->route($this->route_href, ['tpid' => $tpid])->with('error', '删除失败');
            }

            $adv->delete();
        }

        return redirect()->route($this->route_href, ['tpid' => $tpid])->with('success', '删除成功');
    }

}