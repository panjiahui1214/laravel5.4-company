@extends('admin.frame_list')

@section('content_btn')
	<a href="{{ route('article_add') }}">添加文章</a>
@stop

@section('table_data')
	<tr>
		<th>文章标题</th>
		<th>所属菜单</th>
		<th>创建时间</th>
		<th>修改时间</th>
		<th>操作</th>
	</tr>
	@foreach ($articles as $article)
		<tr>
			<td>{{ $article->title }}</td>
			<td>
				@foreach ($article->belong as $menu_id)
					{{ $menu_home->find($menu_id)->name }},
				@endforeach
			</td>
			<td>{{ $article->created_at }}</td>
			<td>{{ $article->updated_at }}</td>
			<td>
				<a href="{{ route('article_upd', ['id' => $article->id]) }}">编辑</a>
				| <a href="{{ route('article_del', ['id' => $article->id]) }}" onclick="if(!confirm('确定要删除吗？')) return false;">删除</a>
			</td>
		</tr>
	@endforeach
@stop

@section('render_data')
	{{ $articles->render() }}
@stop