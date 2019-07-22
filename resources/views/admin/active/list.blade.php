@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('activeTheme') }}">返回</a>
	<a href="{{ route('active_add', ['tid' => $actives['theme']->id]) }}">添加活动</a>
	<a>主题：{{ $actives['theme']->name  }}</a>
@stop

@section('table_data')
			<tr>
				<th>活动名称</th>
				<th>活动时间</th>
				<th>人数</th>
				<th>操作</th>
			</tr>
			@foreach ($actives['actives'] as $active)
				<tr>
					<td>{{ $active->name }}</td>
					@if ( $active->start_time && $active->end_time )
						<td>{{ str_replace("T", " ", $active->start_time) }} ~ {{ str_replace("T", " ", $active->end_time) }}</td>
					@else
						<td></td>
					@endif
					<td>{{ $active_userNum = $active->activesUser->count() }}/{{ $active->user_num }}</td>
					<td>
						@if ($active_userNum)
							<a href="{{ route('active_user', ['tid' => $active->tid, 'id' => $active->id]) }}">报名列表</a> |
						@endif
						<!-- 已结束的不能编辑 -->
						@if (!$active->end_time || strtotime(date('Y-m-d H:i:s', time())) < strtotime($active->end_time))
							<a href="{{ route('active_upd', ['tid' => $active->tid, 'id' => $active->id]) }}">编辑</a>
						@endif
						<!-- 未开始的才能删除 -->
						@if ($active->start_time && strtotime(date('Y-m-d H:i:s', time())) < strtotime($active->start_time))
							| <a href="{{ route('active_del', ['tid' => $active->tid, 'id' => $active->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
						@endif
					</td>
				</tr>
			@endforeach
@stop

@section('render_data')
	{{ $actives['actives']->render() }}
@stop