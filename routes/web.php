<?php

use App\Models\Menu;
use App\Models\MenusAd;


$this->menu = new Menu();

// vendor\laravel\framework\src\Illuminate\Routing\Router.php
Auth::routes();

// 前台首页
Route::get('/', 'Home\IndexController@showIndex');
Route::get('/index', 'Home\IndexController@showIndex');

// 新闻资讯
$ctl_info_font = 'Home\InformationController';
foreach ($this->menu->getSameSort1Menus('info') as $info) {
	Route::get($info->href, $ctl_info_font.'@showInformation');
}
// 文章详情页面
Route::get('/{href1}/{href2}/article/{id}', $ctl_info_font.'@showArticle')
		->where('id', '[0-9]+');

// 创享课程
$ctl_cor_font = 'Home\CourseController';
foreach ($this->menu->getSameSort1Menus('cor') as $cor) {
	Route::get($cor->href, $ctl_cor_font.'@showCourse');
}
// 课程详情页面
Route::get('/{href1}/{href2}/detail/{id}/ce', $ctl_cor_font.'@showCourseDetail')
	->where('id', '[0-9]+');
// 课程报名处理
Route::get('/course/{id}/register', $ctl_cor_font.'@courseRegister')
	->where('id', '[0-9]+');

// 产品服务
$ctl_pro_font = 'Home\ProductController';
foreach ($this->menu->getSameSort1Menus('pro') as $pro) {
	Route::get($pro->href, $ctl_pro_font.'@showProduct');
}

// 关于我们
Route::get('/about', 'Home\AboutUsController@showAboutUs');

// 活动报名
$ctl_act_font = 'Home\ActiveController';
foreach ($this->menu->getSameSort1Menus('act') as $act) {
	Route::get($act->href, $ctl_act_font.'@showActive');
}
// 活动详情页面
Route::get('/{href1}/{href2}/detail/{id}/ae', $ctl_act_font.'@showActiveDetail')
	->where(['id'], '[0-9]+');
// 活动报名处理
Route::get('/active/{id}/register', $ctl_act_font.'@activeRegister')
	->where('id', '[0-9]+');

// 会员中心
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function() {
	$ctl_user_font = 'Home\UserController';
	// 会员首页
	Route::get('/', $ctl_user_font.'@index');
	// 参与活动
	Route::get('/active', $ctl_user_font.'@act')->name('user_active');
	// 参加课程
	Route::get('/course', $ctl_user_font.'@cor')->name('user_course');
	// 个人资料
	Route::get('/profile', $ctl_user_font.'@proView')->name('user_profile');
	Route::post('/profile', $ctl_user_font.'@proPost');
	// 安全中心
	Route::get('/security', $ctl_user_font.'@securityView')->name('user_secur');
	Route::get('/security/password', $ctl_user_font.'@pwdView');
	Route::post('/security/password', $ctl_user_font.'@pwdPost');

	Route::get('/security/mobile', $ctl_user_font.'@mobileView');
	Route::post('/security/mobile', $ctl_user_font.'@mobilePost');

	Route::get('/security/email', $ctl_user_font.'@emailView');
	Route::post('/security/email', $ctl_user_font.'@emailPost');
});


// 忘记密码
$ctl_user_font = 'Home\UserController';
Route::get('/forgetPassword', $ctl_user_font.'@forgetView');
Route::post('/forgetPassword', $ctl_user_font.'@forgetPost');


// AJAX跳转页面
Route::group(['prefix' => 'ajax'], function() {
	$ctl_user_font = 'Home\UserController';
	Route::post('/sendSmsByMobileOrName', $ctl_user_font.'@sendSmsByMobileOrName');
	Route::post('/getMobileFromName', $ctl_user_font.'@getMobileFromName');
});



Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'Auth\AdminLoginController@showLoginForm');
	Route::post('login', 'Auth\AdminLoginController@login');
	Route::post('logout', 'Auth\AdminLoginController@logout');
});

Route::group(['middleware' => ['auth:admin']], function() {
	$this->menusAd = new MenusAd();
	Route::get($this->menusAd->where('ename', 'index')->first()->href,
				'Admin\IndexController@showIndex');

	Route::group(['middleware' => ['role']], function() {
		// 一级菜单的访问
		$first_menus = $this->menusAd->getFirstMenus();
		foreach ($first_menus as $first_menu) {
			Route::get($first_menu->href);
		}

		// 管理员管理
		$href_admin = $this->menusAd->getMenuFromEname('admin')->href;
		$ctl_admin = 'Admin\AdminController';
		Route::get($href_admin, $ctl_admin.'@index')->name('admin');

		Route::get($href_admin.'/add', $ctl_admin.'@addView')->name('admin_add');
		Route::post($href_admin.'/add', $ctl_admin.'@addPost');

		Route::get($href_admin.'/updatePwd/{id}', $ctl_admin.'@updPwdView')->name('admin_updPwd');
		Route::post($href_admin.'/updatePwd/{id}', $ctl_admin.'@updPwdPost');

		Route::get($href_admin.'/updateRole/{id}', $ctl_admin.'@updRoleView')->name('admin_updRole');
		Route::post($href_admin.'/updateRole/{id}', $ctl_admin.'@updRolePost');

		Route::get($href_admin.'/delete/{id}', $ctl_admin.'@del')->name('admin_del');

		// 会员管理
		$href_user = $this->menusAd->getMenuFromEname('user')->href;
		$ctl_user = 'Admin\UserController';
		Route::get($href_user, $ctl_user.'@index')->name('user');

		Route::get($href_user.'/add', $ctl_user.'@addView')->name('user_add');
		Route::post($href_user.'/add', $ctl_user.'@addPost');

		Route::get($href_user.'/updatePwd/{id}', $ctl_user.'@updPwd')->name('user_updPwd');

		Route::get($href_user.'/update/{id}', $ctl_user.'@updView')->name('user_upd');
		Route::post($href_user.'/update/{id}', $ctl_user.'@updPost');

		Route::get($href_user.'/delete/{id}', $ctl_user.'@del')->name('user_del');

		Route::get($href_user.'/{id}/profile', $ctl_user.'@proView')->name('user_pro');

		// 活动主题管理
		$href_active = $this->menusAd->getMenuFromEname('active')->href;
		$ctl_active_theme = 'Admin\ActiveThemeController';
		Route::get($href_active, $ctl_active_theme.'@index')->name('activeTheme');

		Route::get($href_active.'/add', $ctl_active_theme.'@addView')->name('activeTheme_add');
		Route::post($href_active.'/add', $ctl_active_theme.'@addPost');

		Route::get($href_active.'/update/{tid}', $ctl_active_theme.'@updView')->name('activeTheme_upd');
		Route::post($href_active.'/update/{tid}', $ctl_active_theme.'@updPost');

		Route::get($href_active.'/delete/{tid}', $ctl_active_theme.'@del')->name('activeTheme_del');

		// 活动管理
		$ctl_active = 'Admin\ActiveController';
		Route::get($href_active.'/{tid}', $ctl_active.'@index')->name('active');

		Route::get($href_active.'/{tid}/add', $ctl_active.'@addView')->name('active_add');
		Route::post($href_active.'/{tid}/add', $ctl_active.'@addPost');

		Route::get($href_active.'/{tid}/update/{id}', $ctl_active.'@updView')->name('active_upd');
		Route::post($href_active.'/{tid}/update/{id}', $ctl_active.'@updPost');

		Route::get($href_active.'/{tid}/delete/{id}', $ctl_active.'@del')->name('active_del');

		// 报名管理
		$ctl_active_user = 'Admin\ActiveUserController';
		Route::get($href_active.'/{tid}/user/{id}', $ctl_active_user.'@index')->name('active_user');

		// 文章管理
		$href_article = $this->menusAd->getMenuFromEname('article')->href;
		$ctl_article = 'Admin\ArticleController';
		Route::get($href_article, $ctl_article.'@index')->name('article');

		Route::get($href_article.'/add', $ctl_article.'@addView')->name('article_add');
		Route::post($href_article.'/add', $ctl_article.'@addPost');

		Route::get($href_article.'/update/{id}', $ctl_article.'@updView')->name('article_upd');
		Route::post($href_article.'/update/{id}', $ctl_article.'@updPost');

		Route::get($href_article.'/delete/{id}', $ctl_article.'@del')->name('article_del');
		
		// 课程管理
		$href_course = $this->menusAd->getMenuFromEname('course')->href;
		$ctl_course = 'Admin\CourseController';
		Route::get($href_course, $ctl_course.'@index')->name('course');

		Route::get($href_course.'/add', $ctl_course.'@addView')->name('course_add');
		Route::post($href_course.'/add', $ctl_course.'@addPost');

		Route::get($href_course.'/update/{id}', $ctl_course.'@updView')->name('course_upd');
		Route::post($href_course.'/update/{id}', $ctl_course.'@updPost');

		Route::get($href_course.'/delete/{id}', $ctl_course.'@del')->name('course_del');

		// 产品管理
		$href_product = $this->menusAd->getMenuFromEname('product')->href;
		$ctl_product = 'Admin\ProductController';
		Route::get($href_product, $ctl_product.'@index')->name('product');

		Route::get($href_product.'/add', $ctl_product.'@addView')->name('product_add');
		Route::post($href_product.'/add', $ctl_product.'@addPost');

		Route::get($href_product.'/update/{id}', $ctl_product.'@updView')->name('product_upd');
		Route::post($href_product.'/update/{id}', $ctl_product.'@updPost');

		Route::get($href_product.'/delete/{id}', $ctl_product.'@del')->name('product_del');

		// 报名管理
		$ctl_course_user = 'Admin\CourseUserController';
		Route::get($href_course.'/user/{id}', $ctl_course_user.'@index')->name('course_user');

		// 公司信息管理
		$href_company = $this->menusAd->getMenuFromEname('company')->href;
		$ctl_company = 'Admin\CompanyController';
		Route::get($href_company, $ctl_company.'@index')->name('company');

		Route::get($href_company.'/update/{id}', $ctl_company.'@updView')->name('company_upd');
		Route::post($href_company.'/update/{id}', $ctl_company.'@updPost');

		Route::get($href_company.'/delete/{id}', $ctl_company.'@delImg')->name('company_del');

		// 角色管理
		$href_role = $this->menusAd->getMenuFromEname('role')->href;
		$ctl_role = 'Admin\RoleController';
		Route::get($href_role, $ctl_role.'@index')->name('role');

		Route::get($href_role.'/add', $ctl_role.'@addView')->name('role_add');
		Route::post($href_role.'/add', $ctl_role.'@addPost');

		Route::get($href_role.'/update/{id}', $ctl_role.'@updView')->name('role_upd');
		Route::post($href_role.'/update/{id}', $ctl_role.'@updPost');

		Route::get($href_role.'/delete/{id}', $ctl_role.'@del')->name('role_del');

		// 广告位种类管理
		$href_adv = $this->menusAd->getMenuFromEname('advertise')->href;
		$ctl_adv_type = 'Admin\AdvertiseTypeController';
		Route::get($href_adv, $ctl_adv_type.'@index')->name('advType');

		// 广告位管理
		$ctl_adv = 'Admin\AdvertiseController';
		Route::get($href_adv.'/{tpid}', $ctl_adv.'@index')->name('adv');

		Route::get($href_adv.'/{tpid}/add', $ctl_adv.'@addView')->name('adv_add');
		Route::post($href_adv.'/{tpid}/add', $ctl_adv.'@addPost');

		Route::get($href_adv.'/{tpid}/update/{id}', $ctl_adv.'@updView')->name('adv_upd');
		Route::post($href_adv.'/{tpid}/update/{id}', $ctl_adv.'@updPost');

		Route::get($href_adv.'/{tpid}/delete/{id}', $ctl_adv.'@del')->name('adv_del');

	});

});