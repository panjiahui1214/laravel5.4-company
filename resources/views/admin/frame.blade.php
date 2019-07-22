<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>管理中心 - 皮卡丘科技</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>  

  <link rel="alternate icon" type="images/png" href="{{ asset('images/bre_icon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  @section('style')

  @show
</head>

<body>
  @include('message')
  
  <!-- 顶部栏 -->
  @section('header')
    <div class="header">
        <div class="left top-left">
            <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}"></img></a>
        </div>

        <ul class="top-menu">
          @foreach ( $first_menus as $firstMenu )
              @if ( $firstMenu->sort1 == $this_menu->sort1 )
                <li class="left top-menu-li top-menu-active">
                <input type="hidden" value="{{ $sort1 = $firstMenu->sort1 }}" />
              @elseif ( 0 == $this_menu->sort1 )
                <li class="left top-menu-li">
                <input type="hidden" value="{{ $sort1 = 1 }}" />
              @else
                <li class="left top-menu-li">
              @endif
                
                <a href="{{ $firstMenu->href }}">{{ $firstMenu->name }}</a>
              </li>
          @endforeach
        </ul>

        <div class="right top-right">
          <a href="{{ url('/') }}">网站首页</a>
          <span class="gang">|</span>
          <span>{{ Auth::guard('admin')->user()->name }}</span>
          <a href="{{ url('admin/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">[注销]</a>
          <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
    </div>
  @show

  <div class="content">
    <!-- 左侧栏 -->
    @section('left')
      <div class="left left-menu">
        @foreach ( $model_menu->getSecondMenusFromSort1( $sort1 ) as $secondMenu )
          <div>
            <h4 class="left-menu-one">{{ $secondMenu->name }}</h4>
            <div class="right triangle"></div>
          </div>

          <ul class="left-menu-two">
            @foreach ( $model_menu->getThirdMenusFromSort1( $sort1, $secondMenu->sort2 ) as $thirdMenu )
              @if ( $secondMenu->sort2 == $this_menu->sort2 && $thirdMenu->sort3 == $this_menu->sort3 )
                <li class="left-menu-active">
              @else
                <li>
              @endif
                  <a href="{{ $thirdMenu->href }}">{{ $thirdMenu->name }}</a>
                </li>
            @endforeach
          </ul>
        @endforeach
      </div>
    @show

    <!-- 右侧内容 -->
    @section('right')
      <div class="right-all">
        <div class="right-title">{{ $this_menu->name }}</div>
        <div class="right-content">
          @section('content')
            
          @show
        </div>
      </div>
    @show
  </div>

  <script src="{{ asset('js/common.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  @section('javascript')

  @show
</body>
</html>