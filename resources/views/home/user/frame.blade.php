@extends('home.frame')

@section('title', '会员中心')

@section('style')
	<link rel="stylesheet" href="{{ asset('css/user.css') }}"/>
@stop

@section('banner')
	
@stop

@section('content')
	<div class="user-notop">
		<div class="left user-common-div user-left" id="user-left">
			<ul class="txt-center" id="bre-menu-nav">
				<li style="border-bottom: solid 1px #d5dfe8;">
					<a href="/user"><p class="am-icon-home font-s17">欢迎</p></a>
					<p class="margin-b15 font-s17">{{ Auth::user()->name }}</p>
				</li>
				<li><a href="{{ '/user/active' }}">参与活动</a></li>
				<li><a href="{{ '/user/course' }}">参加课程</a></li>
				<li><a href="{{ '/user/profile' }}">个人资料</a></li>
				<li><a href="{{ '/user/security' }}">安全中心</a></li>
			</ul>
		</div>

		<div class="user-common-div user-right">
			@yield('main','主体内容')
		</div>

		<a class="am-icon-btn am-icon-th-list am-show-sm-only margin-b15 right" id="user-menu-btn"></a>
	</div>
@stop