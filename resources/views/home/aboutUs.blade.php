@extends('home.frame')

@section('title', $menu->name)
@section('keywords', $menu->keywords)
@section('description', $menu->description)

@section('img', $menu->img)
@section('curr_title', $menu->name)
@section('curr_ename', $menu->ename2)
@section('menu', $menu->name)
@section('emenu', $menu->ename2)
@section('menu_up', '首页')
@section('menu_up_href', '/index')

@section('content')
  <div class="am-container-1">
    <div class="part-title part-title-mar our-customer">
      <i class="am-icon-paper-plane part-title-i"></i>
      <span class="part-title-span">公司简介</span>
    </div>

    <div class="company-intro">
      <p>我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介</p>
      <p>我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介我是很长很长的公司简介</p>
    </div>
  </div>

  <div class="gray-li company-thought-all customer-case-ul" >
    <div class="am-container-1">
      <ul class="company-thought">
        <li>
          <div class="thought-all">
            <i class="am-icon-circle-o-notch"></i>
            <span>企业理念</span>
            <div class="thought-all-none">
              <h5>专注 专业</h5>
            </div>
          </div>
        </li>
        <li>
          <div class="thought-all">
            <i class="am-icon-bar-chart"></i>
            <span>发展方向</span>
            <div class="thought-all-none">
                <h5>精益求精</h5>
            </div>
          </div>  
        </li>
        <li>
          <div class="thought-all">
            <i class="am-icon-hand-o-right"></i>
            <span>服务理念</span>
            <div class="thought-all-none">
                <h5>实务 用心</h5>
            </div>
          </div>  
        </li>
        <div class="clear"></div>
      </ul>
    </div>
  </div>

  <div class="am-container-1">
    <div class="part-title part-title-mar our-customer">
      <i class=" am-icon-plane part-title-i"></i>
      <span class="part-title-span">发展目标</span>
    </div>
    <div class="company-intro">
      <p class="service-img">我是努力努力努力的发展目标我是努力努力努力的发展目标</p>
    </div>
  </div>
  <div class="am-container-1">
    <div class="part-title part-title-mar our-customer">
      <i class=" am-icon-modx part-title-i"></i>
      <span class="part-title-span">主要业务</span>
    </div>
    <div class="company-intro">
      <p>我是很长很长的公司主要业务介绍我是很长很长的公司主要业务介绍我是很长很长的公司主要业务介绍我是很长很长的公司主要业务介绍我是很长很长的公司主要业务介绍我是很长很长的公司主要业务介绍</p>
    </div>
  </div>

  <div class="gray-li customer-case-ul">
    <div class=" am-container-1">
      <div class="part-title part-title-mar our-customer">
        <i class=" am-icon-comments-o part-title-i"></i>
        <span class="part-title-span">联系我们</span>
        <p>Contact Us</p>
      </div>
    </div>
    <div class="am-container-1">
      <div class="contact-us">
        <div class="am-u-lg-7 am-u-md-7 am-u-sm-12">
          <a href="http://map.baidu.com/?newmap=1&s=inf%26uid%3Dcde9e2c7cfdf53b5e91e97a4%26wd%3D广西人才大厦%26all%3D1%26c%3D340&from=alamap&tpl=map_singlepoint" target="_blank">
            <img src="{{ asset($model_company->getCompanyFromEname('address')->image) }}" title="点击打开百度地图" />
          </a>
        </div>
        <div class="am-u-lg-5 am-u-md-5 am-u-sm-12">
          <ul class="contact-add">
            <li>
              <div>
                <i class="am-icon-map-marker"></i>
                <span class="contact-add-1">{{ $model_company->getCompanyFromEname('address')->value }}</span>
              </div>
            </li>
            <li>
              <div>
                <i class="am-icon-phone"></i>
                <span>{{ $model_company->getCompanyFromEname('tel')->value }}</span>
              </div>         
            </li>
            <li>
              <div>
                <i class="am-icon-envelope-o"></i>
                <span>{{ $model_company->getCompanyFromEname('email')->value }}</span>
              </div>          
            </li>
          </ul>    
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
@stop