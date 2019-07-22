@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('user_add') }}">添加会员</a>
@stop

@section('table_data')
	<tr>
		<th>会员账号</th>
		<th>手机号码</th>
		<th>电子邮箱</th>
		<th>最近登录</th>
		<th>注册时间</th>
		<th>备注</th>
		<th>操作</th>
	</tr>
	@foreach ($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->mobile }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->last_time }}</td>
			<td>{{ $user->created_at }}</td>
			<td>{{ $user->remark }}</td>
			<td>
				<a href="{{ route('user_pro', ['id' => $user->id]) }}">查看</a> |
				<a href="{{ route('user_updPwd', ['id' => $user->id]) }}" onclick="if(!confirm('确定要密码重置吗？')) return false;">密码重置</a> |
				<a href="{{ route('user_upd', ['id' => $user->id]) }}">编辑</a> |
				<a href="{{ route('user_del', ['id' => $user->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $users->render() }}
@stop