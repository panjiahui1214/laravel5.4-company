@extends('home.frame')

@section('title', $menu->name)
@section('keywords', $menu->keywords)
@section('description', $menu->description)

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
        @foreach ($model_menu->getSecondMenusFromEname('cor') as $secondMenu)
          <li class="solutions-tabs-ul-li2">
            <a href="{{ $secondMenu->href }}">
              <i class="am-icon-{{ $secondMenu->img }}"></i>
              <span>{{ $secondMenu->name }}</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="am-tabs-bd solutions-tabs-content">
          <div class="am-tab-panel am-active am-in">

            <div class="am-u-lg-12 am-u-md-12 am-u-sm-12 bre-cor-text">
              <div class="am-u-lg-8 am-u-md-8 am-u-sm-12">
                <h2 class="w-blue">“创享智慧课堂”之{{ $menu->name }}</h2>
                {!! $menu->text !!}
              </div>
              <div class="am-u-lg-4 am-u-md-4 am-u-sm-12 service-img">
                <img src="{{ asset($menu->image) }}" />
              </div>
            </div>

            <div class="left am-u-sm-12 am-u-md-8 am-u-lg-9">
              <ul class="news-ul">
                @forelse ($model2->getArticlesFromMenuId( $menu->id ) as $article)
                  <li class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <a href="{{ $menu->href.'/article/'.$article->id }}">
                      <div class="news-ul-liall">
                        <img class="news-ul-liimg" src="{{ asset($article->cover) }}" />
                        <div class="inform-list">
                          <div class="inform-list-date">
                            <i class="am-icon-arrow-circle-right"></i>
                            {{ substr($article->created_at, 0, 10) }}
                          </div>
                          <div class="inform-list-label">
                            <i class="am-icon-arrow-circle-right"></i>
                            {{ $menu->name }}
                          </div>
                        </div>
                        <span class="bre-art bre-art-title">{{ $article->title }}</span>
                        <p>{{ $article->txt }}</p>
                        <div class="service-img">
                          <span class="see-more3">
                            查看更多<i class="am-icon-angle-double-right"></i>
                          </span>
                        </div>
                      </div>
                    </a>
                  </li>
                @empty
                  <li class="am-u-sm-12 am-u-md-6 am-u-lg-4"></li>
                @endforelse
              </ul>
            </div>

            <div class="right am-u-sm-12 am-u-md-4 am-u-lg-3" style="margin-top: -10px; margin-bottom: 20px;">
              <section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{}'>
                <div class="hot-title">
                  <i class="am-icon-thumbs-o-up"></i>最新课程 / Latest Courses
                </div>
                  @forelse ($model->getCoursesFromMenuId( $menu->id ) as $course)
                    <dl class="am-accordion-item">
                      <dt class="am-accordion-title">{{ $course->name }}</dt>
                      <dd class="am-accordion-bd am-collapse ">
                        <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题，加一个容器 -->
                        <div class="am-accordion-content">
                          <a href="{{ $menu->href.'/detail/'.$course->id.'/ce' }}">{{ $course->description }}</a>
                        </div>
                      </dd>
                    </dl>
                  @empty
                    <dl class="am-accordion-item">
                      <dt class="am-accordion-title txt-center">敬请期待！</dt>
                    </dl>
                  @endforelse
              </section>
            </div>

          </div>
      </div>
  </div>
@stop