@extends('admin.frame_list')

@section('table_data')
	<tr>
		<th>信息名称</th>
		<th>信息值</th>
		<th>信息图片路径</th>
		<th>操作</th>
	</tr>
	@foreach ($companys as $company)
		<tr>
			<td>{{ $company->name }}</td>
			<td>{{ $company->value }}</td>
			<td>{{ $company->image }}</td>
			<td>
				<a href="{{ route('company_upd', ['id' => $company->id]) }}">编辑</a>
				@if ($company->image)
					| <a href="{{ route('company_del', ['id' => $company->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除图片</a>
				@endif
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $companys->render() }}
@stop