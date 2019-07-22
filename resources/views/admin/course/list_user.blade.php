@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('course') }}">返回</a>
	<a>课程：{{ $coursesUsers[0]->course->name }}</a>
@stop

@section('table_data')
	<tr>
		<th>会员账号</th>
		<th>手机号码</th>
		<th>报名时间</th>
	</tr>
	@foreach ($coursesUsers as $coursesUser)
		<tr>
			<td>{{ $coursesUser->user->name }}</td>
			<td>{{ $coursesUser->user->mobile }}</td>
			<td>{{ $coursesUser->created_at }}</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $coursesUsers->render() }}
@stop