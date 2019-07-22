@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('admin_add') }}">添加管理员</a>
@stop

@section('table_data')
	<tr>
		<th>管理员账号</th>
		<th>对应角色</th>
		<th>最近登录</th>
		<th>创建时间</th>
		<th>操作</th>
	</tr>
	@foreach ($admins as $admin)
		<tr>
			<td>{{ $admin->name }}</td>
			<td>
				@if ($admin->rid)
					{{ $adminsRole->find($admin->rid)->name }}
				@endif
			</td>
			<td>{{ $admin->last_time }}</td>
			<td>{{ $admin->created_at }}</td>
			<td>
				@if ($admin->id == Auth::guard('admin')->user()->id)
					<a href="{{ route('admin_updPwd', ['id' => $admin->id]) }}">修改密码</a> |
				@endif
				@if (1 != $admin->id)
					<a href="{{ route('admin_updRole', ['id' => $admin->id]) }}">修改角色</a>
				@endif
				@if (1 != $admin->id || 1 == Auth::guard('admin')->user()->id)
					| <a href="{{ route('admin_del', ['id' => $admin->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $admins->render() }}
@stop