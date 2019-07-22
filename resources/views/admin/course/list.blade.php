@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('course_add') }}">添加课程</a>
@stop

@section('table_data')
	<tr>
		<th>课程名称</th>
		<th>所属菜单</th>
		<th>课程日期</th>
		<th>创建时间</th>
		<th>修改时间</th>
		<th>人数</th>
		<th>操作</th>
	</tr>
	@foreach ($courses as $course)
		<tr>
			<td>{{ $course->name }}</td>
			<td>
				@foreach ($course->belong as $menu_id)
					{{ $menu_home->find($menu_id)->name }},
				@endforeach
			</td>
			@if ( $course->start_date && $course->end_date )
				<td>{{ $course->start_date }} ~ {{ $course->end_date }}</td>
			@else
				<td></td>
			@endif
			<td>{{ $course->created_at }}</td>
			<td>{{ $course->updated_at }}</td>
			<td>{{ $course_userNum = $course->coursesUser->count() }}/{{ $course->user_num }}</td>
			<td>
				@if ($course_userNum)
				<a href="{{ route('course_user', ['id' => $course->id]) }}">报名列表</a> |
				@endif
				<!-- 已结束的不能编辑 -->
				@if (!$course->end_date || strtotime(date('Y-m-d H:i:s', time())) < strtotime($course->end_date))
					<a href="{{ route('course_upd', ['id' => $course->id]) }}">编辑</a>
				@endif
				<!-- 未开始的才能删除 -->
				@if ($course->start_date && strtotime(date('Y-m-d H:i:s', time())) < strtotime($course->start_date))
					| <a href="{{ route('course_del', ['id' => $course->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
				@endif
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $courses->render() }}
@stop