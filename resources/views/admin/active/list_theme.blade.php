@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('activeTheme_add') }}">添加活动主题</a>
@stop

@section('table_data')
	<tr>
		<th>活动主题名称</th>
		<th>创建时间</th>
		<th>操作</th>
	</tr>
	@foreach ($activesThemes as $theme)
		<tr>
			<td>{{ $theme->name }}</td>
			<td>{{ $theme->created_at }}</td>
			<td>
				<a href="{{ route('active', ['tid' => $theme->id]) }}">活动列表 |</a>

				<a href="{{ route('activeTheme_upd', ['tid' => $theme->id]) }}">编辑</a>
				@if ( !$theme->actives->count() )
					| <a href="{{ route('activeTheme_del', ['tid' => $theme->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $activesThemes->render() }}
@stop