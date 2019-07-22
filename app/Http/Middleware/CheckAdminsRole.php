<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\MenusAd;
use App\Models\AdminsRole;

class CheckAdminsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rid = Auth::guard('admin')->user()->rid;
        $menus_id = AdminsRole::find($rid)->menus_id;

        $req_href = '/'.$request->path();
        $req_menu = MenusAd::where('href', $req_href)
                            ->first();

        // 超级管理员
        if (!$menus_id[0]) {
            if ($req_menu && !$req_menu->ename) {
                // 访问一级菜单
                $resp_menu = MenusAd::where('sort1', $req_menu->sort1)
                                    ->whereNotNull('ename')
                                    ->whereNotNull('href')
                                    ->orderBy('sort2')
                                    ->orderBy('sort3')
                                    ->first();
                return redirect($resp_menu->href);
            }
            else {
                // 访问非一级菜单页面
                return $next($request);
            }
        }
        else {
            if ($req_menu && !$req_menu->ename) {
                // 访问一级菜单
                $resp_menu = MenusAd::where('href', 'like', $req_menu->href.'%')
                                ->whereIn('id', $menus_id)
                                ->orderBy('sort2')
                                ->orderBy('sort3')
                                ->first();
                if ($resp_menu) {
                    return redirect($resp_menu->href);
                }
                else {
                    return redirect()->back()->with('error', '无权访问');
                }
            }
            else {
                if ($req_menu) {
                    // 访问三级菜单
                    $if_in = in_array($req_menu->id, $menus_id);
                }
                else {
                    // 访问非菜单页面
                    $href_arr = explode('/', $request->path());
                    $find_href = '/'.$href_arr[0].'/'.$href_arr[1].'/'.$href_arr[2];
                    
                    $if_in = MenusAd::where('href', 'like', $find_href.'%')
                                        ->whereIn('id', $menus_id)
                                        ->count();
                }

                if ($if_in) {
                    return $next($request);
                }
                else {
                    return redirect()->back()->with('error', '无权访问');
                }
            }
        }
    }
}
