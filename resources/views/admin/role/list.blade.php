@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('role_add') }}">添加角色</a>
@stop

@section('table_data')
	<tr>
		<th>角色名称</th>
		<th>角色描述</th>
		<th>拥有权限</th>
		<th>操作</th>
	</tr>
	@foreach ($roles as $role)
		<tr>
			<td>{{ $role->name }}</td>
			<td>{{ $role->description }}</td>
			<td>
				@foreach ($role->menus_id as $menu_id)
					@if (!$menu_id)
						所有
					@else
						{{ $menu->find($menu_id)->name }},
					@endif
				@endforeach
			</td>
			<td>
				@if ($role->id != 1)
					<a href="{{ route('role_upd', ['id' => $role->id]) }}">编辑</a>
				@endif
				@if ( !$role->admins->count() )
					| <a href="{{ route('role_del', ['id' => $role->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $roles->render() }}
@stop