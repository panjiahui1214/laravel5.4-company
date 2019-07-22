@extends('home.frame')

@section('title', $menu->name)

@section('img', $menu_up->img)
@section('curr_title', $menu_up->name)
@section('curr_ename', $menu_up->ename2)
@section('menu', $menu_up->name)
@section('menu_href', $menu_up->href)
@section('menu_up', '首页')
@section('menu_up_href', '/index')

@section('content')
  <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
      <ul class="am-tabs-nav am-cf solutions-tabs-ul" id="bre-menu-nav">
        @foreach ($model_menu->getSecondMenusFromEname('info') as $secondMenu)
          <li class="solutions-tabs-ul-li2">
            <a href="{{ $secondMenu->href }}">
              <i class="am-icon-{{ $secondMenu->img }}"></i>
              <span>{{ $secondMenu->name }}</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="am-tabs-bd solutions-tabs-content">
          <div class="am-tab-panel bre-new-marbot am-active am-in">

            <ul class="solutions-content-ul">
              @foreach ($model->getArticlesFromMenuId( $menu->id ) as $article)
                <li class="am-u-sm-12 am-u-md-6 am-u-lg-12">
                  <a href="{{ $menu->href.'/article/'.$article->id }}">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3 solution-tabs-img">
                      <img src="{{ asset($article->cover) }}" />
                    </div>
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9 solution-tabs-words">
                      <h5 class="bre-art bre-art-title">{{ $article->title }}</h5>
                      <p class="bre-art bre-art-txt">{{ $article->txt }}</p>
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>

          </div>
      </div>
  </div>
@stop