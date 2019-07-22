@extends('home.frame')

@section('title', '皮卡丘科技有限公司')
@section('title_brain', '')

@section('keywords', $model_menu->getMenuFromEname('index')->keywords)
@section('description', $model_menu->getMenuFromEname('index')->description)

@section('banner')
  <div class="rollpic">
    <div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{}' >
      <ul class="am-slides">
        @foreach ($banners as $banner)
          <li><img src="{{ asset($banner->image) }}" /></li>
        @endforeach
      </ul>
    </div>
  </div>
@stop

@section('content')
  <!-- 公司新闻 -->
  <!-- 行业资讯 -->
  @for ($i=3; $i<5; $i++)
    <div class="news-all">
      <div class="am-container-1">
        <div class="news part-all">
          <div class="part-title">
            <a href="{{ $model_menu->getMenuFromIsort($i)->href }}">
              <i class="am-icon-{{ $model_menu->getMenuFromIsort($i)->img }} part-title-i"></i>
              <span class="part-title-span">{{ $model_menu->getMenuFromIsort($i)->name }}</span>
              <p>{{ $model_menu->getMenuFromIsort($i)->ename2 }}</p>
            </a>
          </div>
          <div class="news-content ">
            <ul class="news-content-ul">
              @foreach ($model_article->getTwoArticlesFromMenuId( $model_menu->getMenuFromIsort($i)->id ) as $article)
                <li class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                  <a href="{{ $model_menu->getMenuFromIsort($i)->href.'/article/'.$article->id }}">
                    <div class=" am-u-sm-12 am-u-md-12 am-u-lg-5">
                      <div class="news-img">
                        <img src="{{ asset($article->cover) }}" />
                      </div>
                    </div>
                    <div  class=" am-u-sm-12 am-u-md-12 am-u-lg-7">
                      <span class="news-right-title bre-art bre-art-title">{{ $article->title }}</span>
                      <p class="news-right-time">{{ $article->created_at }}</p>
                      <p class="news-right-words bre-art bre-art-txt">{{ $article->txt }}</p>
                      <a href="{{ $model_menu->getMenuFromIsort($i)->href.'/article/'.$article->id }}">
                        <span class="see-more2">查看更多<i class="am-icon-angle-double-right"></i>
                        </span>
                      </a>
                    </div>
                    <div class="clear"></div>
                  </a>
                </li>
              @endforeach
              <div class="clear"></div>
            </ul>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  @endfor

  <!-- 产品服务 -->
  <div class="am-container-1">
    <div class="solutions part-all">
      <div class="part-title">
        <a href="{{ $model_menu->getMenuFromIsort(1)->href }}">
          <i class="am-icon-{{ $model_menu->getMenuFromIsort(1)->img }} part-title-i"></i>
          <span class="part-title-span">{{ $model_menu->getMenuFromIsort(1)->name }}</span>
          <p>{{ $model_menu->getMenuFromIsort(1)->ename2 }}</p>
        </a>
      </div>
      <ul class="am-g part-content solutions-content">
          @foreach ($model_menu->getSecondMenusFromEname( $model_menu->getMenuFromIsort(1)->ename ) as $secondMenu)
            <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
              <a href="{{ $secondMenu->href }}">
                <img class="solution-circle" src="{{ asset($secondMenu->image) }}" />
                <span class="solutions-title">{{ $secondMenu->name }}</span>
              </a>
              <p class="solutions-way">{{ $secondMenu->txt }}</p>
            </li>
          @endforeach
      </ul>
    </div>
  </div>

  <!-- 创享课程 -->
  <div class="gray-li">
    <div class="customer-case part-all ">
      <div class="part-title">
        <a href="{{ $model_menu->getMenuFromIsort(2)->href }}">
          <i class="am-icon-{{ $model_menu->getMenuFromIsort(2)->img }} part-title-i"></i>
          <span class="part-title-span">{{ $model_menu->getMenuFromIsort(2)->name }}</span>
          <p>{{ $model_menu->getMenuFromIsort(2)->ename2 }}</p>
        </a>
      </div>

      <ul data-am-widget="gallery" class="am-avg-sm-1 am-avg-md-4 am-avg-lg-4 am-gallery-bordered customer-case-content" >
        @foreach ($model_menu->getSecondMenusFromEname( $model_menu->getMenuFromIsort(2)->ename ) as $secondMenu)
          <a href="{{ $secondMenu->href }}">
            <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
              <div class="am-gallery-item case-img1">
                <img src="{{ asset($secondMenu->image) }}" />
              </div>
              <div class="case-li-mengban">
                <div class="case-word">
                  <h3 class="am-gallery-title">{{ $secondMenu->name }}</h3>
                  <p>{{ $secondMenu->txt }}</p>
                  <div class="bre-cor-seem"><i class="am-icon-eye"></i>查看更多</div>
                </div>
              </div>
            </li>
          </a>
        @endforeach
      </ul>

      <div class="lan-bott">
        <div class="left">
          <span>{{ $model_menu->getMenuFromIsort(2)->txt }}</span>
          <p>{{ $model_menu->getMenuFromIsort(2)->etxt }}</p>
        </div>
        <div class="right">
          <a href="{{ $model_menu->getMenuFromIsort(2)->href }}">
          <span class="see-more">查看更多<i class="am-icon-angle-double-right"></i></span>
          </a>
        </div>
        <div class="clear"></div>
      </div>
      <div class="part-title"></div>
    </div>
  </div>

  <!-- 最新课程 -->
  <div class="gray-li">
    <div class="customer am-container-1">
      <div class="am-slider am-slider-default am-slider-carousel part-all" data-am-flexslider="{itemWidth:250, itemMargin: 5, slideshow: false}" style="background-color: #f0eeed; box-shadow:none;">
        <ul class="am-slides">
          @forelse ($courses as $course)
            <li>
              <a href="{{ '/index'.$model_menu->getMenuFromIsort(2)->href.'/detail/'.$course->id.'/ce' }}">
                <p>{{ $course->name }}</p>
                <p><i>课程日期：</i>
                  @if ($course->start_date && $course->end_date)
                    {{ substr($course->start_date,5,2) }}/{{ substr($course->start_date,8,2) }} - {{ substr($course->end_date,5,2) }}/{{ substr($course->end_date,8,2) }}
                  @else
                    长期开展
                  @endif
                </p>
              </a>
            </li>
          @empty
            <li>
              <p>课程正在路上，敬请期待！^,^</p>
            </li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

@stop