<?php

use App\Models\Admin;
use App\Models\AdminsRole;
use Illuminate\Database\Seeder;

class AdminsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminsRole::insert([
            [
                'id'    =>  1,
                'name'	=>	'超级管理员',
                'description'	=>	'权限最大者,拥有后台所有权限',
                'menus_id'		=>	'0'
            ], [
                'id'    =>  2,
                'name'  =>  '发布管理员',
                'description'   =>  '暂时只拥有发布设置模块的权限',
                'menus_id'      =>  '21,22,23'
            ]
        ]);

        Admin::insert([
            'name'  => 'admin',
            'rid'   =>  1,
            'password' => bcrypt('123456')
        ]);
    }
}
