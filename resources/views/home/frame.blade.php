<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
  <meta name=”keywords” Content=@yield('keywords')>
  <meta name=”description” Content=@yield('description')>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link rel="alternate icon" type="images/png" href="{{ asset('images/logo_icon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/amazeui.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  @section('style')

  @show
</head>

<body>
  @include('message')
  
  <!-- 头部 -->
  @section('header')
    <header class="am-topbar header">
      <div class="am-container-1">

        <div class="left bre-logo">
          <a href="{{ $model_menu->getMenuFromEname('index')->href }}">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="LOGO"></img>
          </a>
        </div>

        <div class="right logio-nav">
          <ul>
            @if (Auth::guest())
              <li class="right logio-nav-btn"><a href="{{ route('register') }}">注册</a></li>
              <li class="right logio-nav-btn"><a href="{{ route('login') }}">登录</a></li>
            @else
              <li class="right logio-nav-btn">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">注销</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
              <li class="right w-blue">
                <a href="{{ url('user') }}">{{ Auth::user()->name }}</a>
              </li>
            @endif
          </ul>
        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
          <span class="am-sr-only">导航切换</span>
          <span class="am-icon-bars"></span>
        </button>
        
        <div class="am-collapse am-topbar-collapse right" id="doc-topbar-collapse">    
          <div class="am-topbar-left am-form-inline am-topbar-right" role="search">
            <ul class="am-nav am-nav-pills am-topbar-nav bre-menu" id="bre-nav">
              <li><a href="{{ $model_menu->getMenuFromEname('index')->href }}">首页</a></li>
              @foreach($model_menu->getFirstMenus() as $firstMenu)
                <li><a href="{{ $firstMenu->href }}">{{ $firstMenu->name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>

      </div>
    </header>
  @show

  @section('banner')
    <div class="toppic">
      <div class="am-container-1">
        <div class="toppic-title left">
          <i class="am-icon-@yield('img') toppic-title-i"></i>
          <span class="toppic-title-span">@yield('curr_title')</span>
          <p>@yield('curr_ename')</p>
        </div>

        <div class="right toppic-progress">
          <span><a href="@yield('menu_up_href')" class="w-white">@yield('menu_up')</a></span>
          <i class="am-icon-arrow-circle-right w-white"></i>
          <span><a href="@yield('menu_href')" class="w-white">@yield('menu')</a></span>
        </div>
      </div>
    </div>
  @show

  <!-- 主体内容 -->
  @yield('content','主体内容')

  <!-- 尾部 -->
  @section('footer')
    <footer class="footer ">
      <ul>
        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12 bre-wxgz">
          <div class="part-5-title bre-wxgz-txt">微信关注</div>
          <div class="part-5-words2">
            <img src="{{ ($wechat = $model_company->getCompanyFromEname('wechat')) ? asset($wechat->image) : '' }}" alt="微信二维码">
          </div>
        </li>

        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12">
          <div class="part-5-title">关注我们</div>
          <div class="part-5-words2">
            <span>微信号：{{ ($wechat = $model_company->getCompanyFromEname('wechat')) ? $wechat->value : '' }}</span>
            <span>Email：{{ ($email = $model_company->getCompanyFromEname('email')) ? $email->value : '' }}</span>
            <span>
              <i class="am-icon-phone"></i>
              <em>客服电话：{{ ($tel = $model_company->getCompanyFromEname('tel')) ? $tel->value : '' }}</em>
            </span>
          </div>
        </li>

        <li class="am-u-lg-4 am-u-md-4 am-u-sm-12 ">
          <div class="part-5-title">相关链接</div>
          <div class="part-5-words2">
            <ul class="part-5-words2-ul">
              @foreach($model_menu->getFirstMenus() as $firstMenu)
                <li class="am-u-lg-4 am-u-md-6 am-u-sm-4">
                  <a href="{{ $firstMenu->href }}">{{ $firstMenu->name }}</a>
                </li>
              @endforeach
              <div class="clear"></div>
            </ul>
          </div>
        </li>
        <div class="clear"></div>
      </ul>
    </footer>
  @show

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/amazeui.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/scroll.js') }}"></script>
  <script src="{{ asset('js/common.js') }}"></script>
  <script src="{{ asset('js/home.js') }}"></script>
  @section('javascript')

  @show
</body>
</html>