@extends('admin.frame_list')

@section('table_data')
	<tr>
		<th>广告位种类名称</th>
		<th>图片宽度</th>
		<th>图片高度</th>
		<th>广告位种类描述</th>
		<th>操作</th>
	</tr>
	@foreach ($advertiseTypes as $advType)
		<tr>
			<td>{{ $advType->name }}</td>
			<td>{{ $advType->width }}</td>
			<td>{{ $advType->height }}</td>
			<td>{{ $advType->description }}</td>
			<td>
				<a href="{{ route('adv', ['tpid' => $advType->id]) }}">广告位列表</a>
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $advertiseTypes->render() }}
@stop