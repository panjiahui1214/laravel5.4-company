@extends('home.user.frame')

@section('main')
	<ul class="user-security-ul">
		<li>
			<i class="am-icon-lock"></i>
			<span class="user-security-title">登录密码</span>
			<span class="user-security-content">为确保您账号安全性，请定期更换密码</span>
			<a href="/user/security/password">修改</a>
		</li>
		<li>
			<i class="am-icon-mobile font-s36"></i>
			<span class="user-security-title">绑定手机</span>
			<span class="user-security-content">您绑定的手机号码为：{{ $user->mobile }}</span>
			<a href="/user/security/mobile">修改</a>
		</li>
		<li>
			@if ($user->email)
				<i class="am-icon-envelope"></i>
				<span class="user-security-title">绑定邮箱</span>
				<span class="user-security-content">您绑定的电子邮箱为：{{ $user->email }}</span>
				<a href="/user/security/email">修改</a>
			@else
				<i class="am-icon-envelope" style="color: orangered !important;"></i>
				<span class="user-security-title">绑定邮箱</span>
				<span class="user-security-content">您还未绑定电子邮箱，建议尽快绑定</span>
				<a href="/user/security/email">绑定</a>
			@endif
		</li>
	</ul>
@stop