@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('product_add') }}">添加产品</a>
@stop

@section('table_data')
	<tr>
		<th>产品名称</th>
		<th>所属菜单</th>
		<th>购买地址</th>
		<th>操作</th>
	</tr>
	@foreach ($products as $product)
		<tr>
			<td>{{ $product->name }}</td>
			<td>
				@foreach ($product->belong as $menu_id)
					{{ $menu_home->find($menu_id)->name }},
				@endforeach
			</td>
			<td>{{ $product->href }}</td>
			<td>
				<a href="{{ route('product_upd', ['id' => $product->id]) }}">编辑</a>
				| <a href="{{ route('product_del', ['id' => $product->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $products->render() }}
@stop