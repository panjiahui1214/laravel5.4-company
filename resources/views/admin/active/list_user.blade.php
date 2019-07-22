@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('active', ['tid' => $activesUsers[0]->active->tid]) }}">返回</a>
	<a>主题：{{ $activesUsers[0]->active->theme->name }}</a>
	<a>活动：{{ $activesUsers[0]->active->name }}</a>
@stop

@section('table_data')
	<tr>
		<th>会员账号</th>
		<th>手机号码</th>
		<th>报名时间</th>
	</tr>
	@foreach ($activesUsers as $activesUser)
		<tr>
			<td>{{ $activesUser->user->name }}</td>
			<td>{{ $activesUser->user->mobile }}</td>
			<td>{{ $activesUser->created_at }}</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $activesUsers->render() }}
@stop