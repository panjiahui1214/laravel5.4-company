<?php

use App\Models\Advertise;
use App\Models\AdvertisesType;
use Illuminate\Database\Seeder;

class AdvertisesAndTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdvertisesType::insert([
            'id'        =>  1,
            'ename'     =>  'banner',
            'name'      =>  '首页横幅',
            'height'	=>	295,
            'width'		=>	1500,
            'description'   =>  '存放公司宣传横幅'
        ]);

        Advertise::insert([
            'name'  =>  '首页横幅1',
            'tpid'  =>  1,
            'sort'  =>  1,
            'image'	=>	'uploads/advertise/images/banner_1.jpg',
            'href'  =>  '#'
        ]);

        Advertise::insert([
            'name'  =>  '首页横幅2',
            'tpid'  =>  1,
            'sort'  =>  2,
            'image'	=>	'uploads/advertise/images/banner_2.jpg',
            'href'  =>  '#'
        ]);

        Advertise::insert([
            'name'  =>  '首页横幅3',
            'tpid'  =>  1,
            'sort'  =>  3,
            'image'	=>	'uploads/advertise/images/banner_3.jpg',
            'href'  =>  '#'
        ]);
    }
}
