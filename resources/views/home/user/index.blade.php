@extends('home.user.frame')

@section('main')
	<span class="blue user-index-welcome">欢迎光临！</span>
	<span class="blue user-index-time">最近登录时间：{{ $user->last_time }}</span>

	<table class="user-index-table">
		<tr>
			<th>会员账号：</td>
			<td class="padding-l10">{{ $user->name }}</td>
			<td></td>
		</tr>
		<tr>
			<th>登录密码：</td>
			<td class="padding-l10">********</td>
			<td class="padding-l50">
				<a href="/user/security/password">修改</a>
			</td>
		</tr>
		<tr>
			<th>手机号码：</td>
			<td class="padding-l10">{{ $user->mobile }}</td>
			<td class="padding-l50">
				<a href="/user/security/mobile">修改</a>
			</td>
		</tr>
		<tr>
			<th>电子邮箱：</td>
			<td class="padding-l10">{{ $user->email }}</td>
			<td class="padding-l50">
				<a href="/user/security/email">修改</a>
			</td>
		</tr>
		<tr>
			<th>参与活动：</td>
			<td class="padding-l10">{{ $user->actives()->count() }}个</td>
			<td class="padding-l50">
				<a href="{{ '/user/active' }}">查看</a>
			</td>
		</tr>
		<tr>
			<th>参加课程：</td>
			<td class="padding-l10">{{ $user->courses()->count() }}个</td>
			<td class="padding-l50">
				<a href="{{ '/user/course' }}">查看</a>
			</td>
		</tr>
	</table>
@stop