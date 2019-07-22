<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert([
            'ename'		=>	'wechat',
            'name'		=>	'微信号',
            'value'		=>	'皮卡丘潘',
            'image'     =>  'uploads/company/images/wechat.jpg'
        ]);
        Company::insert([
            'ename'		=>	'email',
            'name'		=>	'电子邮箱',
            'value'		=>	'123456@qq.com',
        ]);
        Company::insert([
            'ename'		=>	'tel',
            'name'		=>	'客服电话',
            'value'		=>	'0771-123456',
        ]);
        Company::insert([
            'ename'		=>	'address',
            'name'		=>	'地址',
            'value'		=>	'广西南宁市青秀区金州路33号广西人才大厦',
            'image'     =>  'uploads/company/images/address.jpg'
        ]);
    }
}
