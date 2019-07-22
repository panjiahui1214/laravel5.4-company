@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('advType') }}">返回</a>
	<a href="{{ route('adv_add', ['tpid' => $advertises[0]->tpid]) }}">添加广告位</a>
	<a>种类：{{ $advertises[0]->type->name }}</a>
@stop

@section('table_data')
	<tr>
		<th>广告位中文名称</th>
		<th>排序</th>
		<th>图片路径</th>
		<th>图片链接</th>
		<th>操作</th>
	</tr>
	@foreach ($advertises as $advertise)
		<tr>
			<td>{{ $advertise->name }}</td>
			<td>{{ $advertise->sort }}</td>
			<td>{{ $advertise->image }}</td>
			<td>{{ $advertise->href }}</td>
			<td>
				<a href="{{ route('adv_upd', ['tpid' => $advertise->tpid, 'id' => $advertise->id]) }}">编辑</a>
				| <a href="{{ route('adv_del', ['tpid' => $advertise->tpid, 'id' => $advertise->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $advertises->render() }}
@stop