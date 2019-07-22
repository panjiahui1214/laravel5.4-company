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
			@foreach ( $model_menu->getSecondMenusFromEname('act') as $secondMenu )
				<li class="solutions-tabs-ul-li2">
					<a href="{{ $secondMenu->href }}">
						<i class="am-icon-{{ $secondMenu->img }}"></i>
						<span>{{ $secondMenu->name }}</span>
					</a>
		        </li>
		    @endforeach
		</ul>

		<div class="am-tabs-bd solutions-tabs-content" id="bre-nav-div">
			<div class="am-tab-panel am-active am-in">

			    	<ul class="service-ul">
						@forelse ( $model->getFontActives($menu->ename) as $active )
					    	<li class="am-u-lg-12 am-u-md-12 am-u-sm-12 margin-t0">
					    		<div class="am-u-lg-8 am-u-md-8 am-u-sm-12 service-content">
					    			<h4 class="w-blue">
					    				<a href="{{ $menu->href.'/detail/'.$active->id.'/ae' }}">{{ $active->name }}——{{ $active->theme->name }}</a>
					    			</h4>
					    			<p><i>活动时间：</i>
						    			@if ( $active->start_time && $active->end_time )
						    				{{ $active->start_time }} ~ {{ $active->end_time }}
						    			@else
						    				长期有效
						    			@endif
					    			</p>
					    		</div>
					    		<div class="am-u-lg-4 am-u-md-4 am-u-sm-12 service-img">
					    			<a href="{{ $menu->href.'/detail/'.$active->id.'/ae' }}" class="w-blue">查看详情</a>
					    			<!-- 已结束的活动不能报名 -->
					    			@if ( 'act_end' != $menu_up->ename )
					    				<a href="{{ '/active/'.$active->id.'/register' }}" class="padding-l10 w-blue" onclick="if(!confirm('确定要报名吗？')) return false;">立即报名</a>
					    			@endif
					    		</div>
					    	</li>
					    @empty
					    	<p class="txt-center">暂时没有<b>{{ $menu->name }}</b>，敬请期待！</p>
					    	<p class="txt-center margin-b15">请点击上面 <span class="w-blue">浅蓝色选项卡↑</span> 查看其他活动</p>
				    	@endforelse
			    	</ul>

			</div>
		</div>
	</div>
@stop